<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartBooking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function servicePrice(){
        return $this->belongsTo(ServicePrice::class, 'service_price_id');
    }

    public function subBooking(){
        return $this->belongsTo(SubBook::class, 'sub_booking_id');
    }

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }


}
