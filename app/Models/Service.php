<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(CategoryService::class, 'category_service_id');
    }

    // protected $casts = [
    //     'staff_id' => 'array',
    //     'facility_id' => 'array'
    // ];
}
