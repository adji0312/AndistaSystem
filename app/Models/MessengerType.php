<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessengerType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function locations(){
        return $this->hasMany(LocationContactMessenger::class);
    }

    public function customers(){
        return $this->belongsTo(MessengerType::class);
    }
}
