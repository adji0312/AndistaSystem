<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function workinghours(){
        return $this->hasMany(WorkingHours::class);
    }

    public function facilities(){
        return $this->hasMany(Facility::class);
    }

    public function locationaddresses(){
        return $this->hasMany(LocationAddress::class);
    }

    public function phones(){
        return $this->hasMany(LocationContactPhone::class);
    }
    public function emails(){
        return $this->hasMany(LocationContactEmail::class);
    }
    public function messengers(){
        return $this->hasMany(LocationContactMessenger::class);
    }
    public function plans(){
        return $this->hasMany(Plan::class);
    }

    public function serviceprices(){
        return $this->hasMany(ServicePrice::class, 'id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('location_name', 'like', '%' . $search . '%');
        });
    }
}
