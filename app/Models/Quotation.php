<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function location(){
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
