<?php

namespace App\Http\Controllers\Staff\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        return view('admin.page.booking.index',[
            'bookings' => Booking::with('user','tickets','tickets.travel')->get(),
        ]);
    }
}
