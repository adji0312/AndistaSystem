<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckStaff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function serviceprice(){
        return $this->belongsTo(ServicePrice::class,'service_price_id');
    }
    public function staff(){
        return $this->belongsTo(Staff::class,'staff_id');
    }
}
