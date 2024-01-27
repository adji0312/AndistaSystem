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

    public function workdays(){
        return $this->hasMany(Workdays::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('first_name', 'like', '%' . $search . '%')
                         ->orWhere('middle_name', 'like', '%' . $search . '%')
                         ->orWhere('last_name', 'like', '%' . $search . '%')
                         ->orWhere('email', 'like', '%' . $search . '%')
                         ->orWhere('phone', 'like', '%' . $search . '%');
        });
    }
}
