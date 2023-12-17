<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDiagnosis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function diagnosis(){
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    public function treatment(){
        return $this->belongsTo(Plan::class, 'treatment_id');
    }
}
