<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TicketsBooking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

class TicketBookingController extends Controller
{
    public $currently_booked = [];

    // Function to check if consecutive seats are available in a row
    function areSeatsAvailable($row, $numSeats)
    {
        $consecutiveCount = 0;
        foreach ($row as $seat) {
            if ($seat == '0') { // Check if seat is available
                $consecutiveCount++;
                if ($consecutiveCount == $numSeats) {
                    return true;
                }
            } else {
                $consecutiveCount = 0;
            }
        }
        return false;
    }

    // Function to reserve seats in a train coach
    function reserveSeats(&$coach, $numSeats)
    {

        $rows = count($coach);

        // Check if seats can be reserved in one row
        for ($i = 0; $i < $rows; $i++) {
            if ($this->areSeatsAvailable($coach[$i], $numSeats)) {
                // Reserve seats in the row

                for ($j = 0; $j < count($coach[$i]); $j++) {
                    $temp = [];
                    if ($coach[$i][$j] == '0' && $numSeats > 0) {
                        $coach[$i][$j] = '1';
                        $temp[] = $i;
                        $temp[] = $j;
                        $this->currently_booked[] = $temp;
                        $numSeats--;
                    }
                }
                return;
            }


        }

        // If seats cannot be reserved in one row, book nearby seats
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < count($coach[$i]); $j++) {
                $temp = [];
                if ($coach[$i][$j] == '0' && $numSeats > 0) {
                    $coach[$i][$j] = '1';
                    $temp[] = $i;
                    $temp[] = $j;
                    $this->currently_booked[] = $temp;
                    $numSeats--;
                }
            }
        }
        ;
    }


    // function which loads HomePage
    function loadHome(Request $request)
    {
        try {
            return view('welcome');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to load homepage.');
        }
    }

    //function to process book tickets
    function BookTickets(Request $request)
    {
        try {

            //validating the number of tickets input 
            $ticketData = $request->validate([
                'tickets-input' => 'required|numeric|min:1|max:7',
            ]);

            $numSeats = $ticketData['tickets-input'];

            $coach = [];
            $cols = 7;
            $seat_index = 0;
            
            //fetching already stored tickets from db
            $tickets = TicketsBooking::first();

            //count available seats ('0' -> available, '1' -> booked)
            $available_seats = substr_count($tickets->all_seats, '0');

            //check weather seats are available or not
            if ($available_seats < $numSeats) {
                if ($available_seats == 0) {
                    $request->session()->flash('error', 'Sorry, Seats are not available at moment.');
                } else
                    $request->session()->flash('error', 'Sorry, ' . $numSeats . ' seats are not currently available. Only ' . $available_seats . ' are available.');
                return back();
            }


            // Fill the array with the "seats-string" from the database
            for ($i = 0; $i < 12; $i++) {
                if ($i == 11) $cols = 3;
                for ($j = 0; $j < $cols; $j++) {
                    $coach[$i][$j] = $tickets->all_seats[$seat_index];
                    $seat_index++;
                }
            }



            $final_seats = '';

            //calling reserveSeats function
            $this->reserveSeats($coach, $numSeats);

            //updating all booked seats "final_seats" variable
            foreach ($coach as $row) {
                foreach ($row as $seat) {
                    $final_seats = $final_seats . $seat;
                }
            }
            
            //saving updated seats string to the db
            $tickets->all_seats = $final_seats;
            $tickets->save();




            // Retrieve the currently_booked seats
            $data['currently_booked'] = $this->currently_booked;


            $seat_numbers = [];
            $column_count = 7;

            //process the matrix of 7x7 to calculate exact position of booked seats ranges from (0 to 79) total 80 seats
            foreach ($data['currently_booked'] as $seat_indexes) {
                $final_position = ($seat_indexes[0] * $column_count) + $seat_indexes[1];
                $seat_numbers[] = $final_position;
            }

            // Store the modified array back in the session
            Session::put('seat_numbers', $seat_numbers);
            Session::put('total_tickets', $numSeats);

            return redirect()->route('ticket-information');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to reserve seats.');
        }
    }
    
    // booked-tickets information page
    function loadTicketInfo(Request $request)
    {
        try {
            //fetching data from the session
            $data['currently_booked'] = Session::get('seat_numbers', []);
            $data['total_tickets'] = Session::get('total_tickets');
            
            //fetching already stored "booked_seats" string
            $tickets = TicketsBooking::first();
            $data['already_booked'] = $tickets;

            //process final output
            $final_output = [];
            $seat_string = $tickets->all_seats;

            for ($i = 0; $i < strlen($seat_string); $i++) {
                $temp = [];
                $temp[] = $seat_string[$i];
                //checking if seats is booked now or is already booked
                if (in_array($i, $data['currently_booked'])) {
                    $temp[] = true;
                } else {
                    $temp[] = false;
                }
                
                $final_output[] = $temp;
            }

            //final_output contains updated status of all booked seats
            $data['booked_seats'] = $final_output;

            return view('ticket-info', $data);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to load ticket information.');
        }
    }

    
    //function to reset the data from table
    function resetDB(Request $request)
    {
        try {
            TicketsBooking::truncate();

            // Seeding Command
            Artisan::call('db:seed');
            
            Session::flush();

            $request->session()->flash('success', 'All progress erased successfully.');

            return back();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to reset Database.');
        }
    }



}