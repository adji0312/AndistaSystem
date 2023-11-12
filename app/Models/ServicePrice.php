<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo(Location::class, 'location_price_id');
    }
}
