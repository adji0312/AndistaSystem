<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lists(){
        return $this->hasMany(Task::class);
    }

    public function diagnosis(){
        return $this->belongsTo(Diagnosis::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function listPlan(){
        return $this->hasMany(ListPlan::class);
    }
}
