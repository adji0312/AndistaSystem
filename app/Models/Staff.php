<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }

    public function position(){
        return $this->belongsTo(Position::class,'position_id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'shifts_id');
    }

    public function subbooks(){
        return $this->hasMany(SubBook::class);
    }

    // public function service(){
    //     return $this->hasMany(Position::class);
    // }
}
