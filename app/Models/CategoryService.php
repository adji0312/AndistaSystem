<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function services(){
        return $this->hasMany(Service::class, 'id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('category_service_name', 'like', '%' . $search . '%');
        });
    }
}
