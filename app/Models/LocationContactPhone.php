<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationContactPhone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function locations(){
        return $this->belongsTo(Location::class);
    }

    public function usagecontacts(){
        return $this->belongsTo(UsageContact::class);
    }
}
