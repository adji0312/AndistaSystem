<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationContactMessenger extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function locations(){
        return $this->belongsTo(Location::class);
    }

    public function usagecontacts(){
        return $this->belongsTo(UsageContact::class, 'usage_messenger_contact_id');
    }

    public function messengertypes(){
        return $this->belongsTo(MessengerType::class, 'messenger_type_id');
    }
}
