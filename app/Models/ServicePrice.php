<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo(Location::class, 'location_price_id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function bookingCart(){
        return $this->hasMany(CartBooking::class);
    }
}
