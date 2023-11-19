<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function idtypes(){
        return $this->hasOne(Background::class);
    }

    public function jobs(){
        return $this->hasOne(Job::class);
    }
}
