<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingNote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subbooking(){
        return $this->belongsTo(SubBook::class, 'sub_booking_id');
    }
}
