<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketsBooking;

class TicketbookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TicketsBooking::create([
            'all_seats' => '00000000000000000000000000000000000000000000000000000000000000000000000000000000',
        ]);
    }
}
