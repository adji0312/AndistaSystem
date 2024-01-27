<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function brands(){
        return $this->hasOne(Brand::class,'id');
    }

    public function suppliers(){
        return $this->hasOne(Suppliers::class,'id');
    }

    public function categories(){
        return $this->hasOne(Category::class,'id');
    }

    public function taxrates(){
        return $this->hasOne(TaxRate::class,'id');
    }

    public function carts(){
        return $this->hasMany(CartBooking::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('product_name', 'like', '%' . $search . '%');
        });
    }
}
