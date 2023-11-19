<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdType extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function background(){
        return $this->belongsTo(Background::class);
    }

    public function staffbackgrounds(){
        return $this->hasOne(StaffBackground::class);
    }
}
