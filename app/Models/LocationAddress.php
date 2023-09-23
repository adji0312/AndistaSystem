<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationAddress extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function usageaddress(){
        return $this->belongsTo(UsageAddress::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
