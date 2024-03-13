<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function sub_booking(){
        return $this->belongsTo(SubBook::class, 'sub_booking_id');
    }

    public function invoicepayment(){
        return $this->hasMany(InvoicePayment::class, 'invoice_id');
    }

    public function carts(){
        return $this->hasMany(CartBooking::class, 'invoice_id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('customer_name', 'like', '%' . $search . '%')
                         ->orWhere('sub_account_name', 'like', '%' . $search . '%');
        });
    }
}
