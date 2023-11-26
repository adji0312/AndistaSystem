<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function servicePrice(){
        return $this->belongsTo(ServicePrice::class, 'service_price_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'service_staff_id');
    }
}
