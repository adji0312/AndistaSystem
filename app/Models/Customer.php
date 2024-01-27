<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function adresses(){
        return $this->hasOne(Address::class);
    }

    public function backgrounds(){
        return $this->hasOne(Background::class);
    }

    public function clientgrup(){
        return $this->hasOne(ClientGrup::class);
    }

    public function messeng(){
        return $this->hasOne(MessengerType::class);
    }

    public function pets(){
        return $this->hasMany(Pet::class);
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
