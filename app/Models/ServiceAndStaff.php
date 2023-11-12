<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAndStaff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    // public function staff(){
    //     return $this->belongsTo(Staff::class);
    // }
}
