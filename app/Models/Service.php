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

    public function listplans(){
        return $this->hasMany(ListPlan::class, 'id');
    }
    
    public function carts(){
        return $this->hasMany(CartBooking::class);
    }

    public function prices(){
        return $this->hasMany(ServicePrice::class, 'service_id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('service_name', 'like', '%' . $search . '%');
        });
    }

    // protected $casts = [
    //     'staff_id' => 'array',
    //     'facility_id' => 'array'
    // ];
}
