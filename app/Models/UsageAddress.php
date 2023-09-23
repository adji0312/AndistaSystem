<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageAddress extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function locationaddresses(){
        return $this->hasMany(LocationAddress::class);
    }
}
