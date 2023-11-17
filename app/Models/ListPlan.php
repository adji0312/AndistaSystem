<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPlan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function services(){
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function products(){
        // return $this->belongsTo(::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }


}
