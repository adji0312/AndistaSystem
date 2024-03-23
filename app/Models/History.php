<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function booking(){
        return $this->belongsTo(SubBook::class, 'booking_id');
    }

    public function treatment(){
        return $this->belongsTo(Plan::class, 'treatment_id');
    }

    public function invoice(){
        return $this->belongsTo(Sale::class, 'invoice_id');
    }
}
