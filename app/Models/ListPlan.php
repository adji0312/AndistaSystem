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
}
