<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function countries(){
        return $this->hasOne(Country::class);
    }
}
