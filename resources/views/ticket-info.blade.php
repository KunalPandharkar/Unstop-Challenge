@extends('Layouts.MainLayout')

@section('content')
    <div class="d-flex main-container container ">

        <div class="container booking-main">
            <button type="button" class="btn btn-link"  onclick="location.href='{{route('home')}}'">&larr; Back</button>
            <h1 class="text-center text-success success-message">Congratulations, Your booking is confirmed.</h1>
            <div class="booking-details text-center">
                <p><span>Number of Seats Booked:</span> <span class="seat text-success">{{ $total_tickets }}</span></p>
            </div>
             {{-- Displaying Seat Numbers --}}
            <div class="seat-numbers text-center">
                <p>Seat Numbers:</p>
                <p>
                    @foreach ($currently_booked as $seats)
                        S{{ $seats + 1 }}
                        @if ($loop->last)
                        @else
                            ,
                        @endif
                    @endforeach
                </p>
            </div>

            <div class="seat-numbers text-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Your Seats</th>
                            <th>Already Booked</th>
                            <th>Available Seats</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="seat booked"></div>
                            </td>
                            <td>
                                <div class="seat already-booked"></div>
                            </td>
                            <td>
                                <div class="seat "></div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>


        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">

                    @for ($i = 0; $i < 80;)
                        @if ($i == 77)
                            <div class="seats-container">
                                <div class="seat @if ($booked_seats[$i][1] == true) booked @elseif($booked_seats[$i][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 1][1] == true) booked @elseif($booked_seats[$i+1][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 2][1] == true) booked @elseif($booked_seats[$i+2][0] == '1') already-booked @endif"></div>
                            </div>
                            @php
                                $i += 3;
                            @endphp
                        @else
                            <div class="seats-container">
                                <div class="seat @if ($booked_seats[$i][1] == true) booked  @elseif($booked_seats[$i][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 1][1] == true) booked @elseif($booked_seats[$i+1][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 2][1] == true) booked @elseif($booked_seats[$i+2][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 3][1] == true) booked @elseif($booked_seats[$i+3][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 4][1] == true) booked @elseif($booked_seats[$i+4][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 5][1] == true) booked @elseif($booked_seats[$i+5][0] == '1') already-booked @endif"></div>
                                <div class="seat @if ($booked_seats[$i + 6][1] == true) booked @elseif($booked_seats[$i+6][0] == '1') already-booked @endif"></div>
                            </div>
                            @php
                                $i += 7;
                            @endphp
                        @endif
                    @endfor


                </div>
            </div>
        </div>

    </div>
@endsection
