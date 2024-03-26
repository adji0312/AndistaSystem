<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function plans(){
        return $this->hasMany(Plan::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('diagnosis_name', 'like', '%' . $search . '%');
        });
    }
}
