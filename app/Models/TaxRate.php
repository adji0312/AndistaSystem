<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function taxrate(){
        return $this->belongsTo(Product::class);
    }
}
