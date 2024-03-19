<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPlanBooking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function listplan(){
        return $this->belongsTo(ListPlan::class, 'list_plan_id');
    }

    public function bookingdiagnoses(){
        return $this->belongsTo(BookingDiagnosis::class, 'booking_diagnoses_id');
    }

}
