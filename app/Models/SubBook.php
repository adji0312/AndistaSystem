<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBook extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function pet(){
        return $this->belongsTo(Pet::class, 'subAccount_id');
    }
    
    public function carts(){
        return $this->hasMany(CartBooking::class, 'sub_booking_id');
    }

    public function service(){
        return $this->hasMany(BookingService::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
