<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staffs(){
        return $this->belongsTo(Staff::class);
    }

    public function job(){
        return $this->hasMany(Job::class);
    }
}
