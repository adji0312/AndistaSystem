<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function services(){
        return $this->hasMany(BookingService::class);
    }

    public function servicesPrice(){
        return $this->hasMany(ServicePrice::class);
    }

    public function service(){
        return $this->belongsTo(Service::class ,'');
    }


    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function carts(){
        return $this->hasMany(CartBooking::class);
    }

    public function subbookings(){
        return $this->hasMany(SubBook::class);
    }
}
