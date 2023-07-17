<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HomePage Route 
Route::get('/', [TicketBookingController::class, 'loadHome'])
    ->name('home');

//Route to book tickets
Route::post('/book-tickets', [TicketBookingController::class, 'BookTickets'])
    ->name('book-tickets');

// display tickets information
Route::get('/ticket-information', [TicketBookingController::class, 'loadTicketInfo'])
    ->name('ticket-information');

//to reset all database
Route::get('/reset-all', [TicketBookingController::class, 'resetDB'])
    ->name('reset-all');

