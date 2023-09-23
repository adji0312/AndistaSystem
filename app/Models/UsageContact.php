<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageContact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function phones(){
        return $this->hasMany(LocationContactPhone::class);
    }
    
    public function emails(){
        return $this->hasMany(LocationContactEmail::class);
    }

    public function messengers(){
        return $this->hasMany(LocationContactMessenger::class);
    }
}
