<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
