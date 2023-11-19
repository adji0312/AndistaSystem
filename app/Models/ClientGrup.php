<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGrup extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
