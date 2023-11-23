<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function roles(){
        return $this->hasOne(Role::class,'id');
    }

    // public function service(){
    //     return $this->hasMany(Position::class);
    // }
}
