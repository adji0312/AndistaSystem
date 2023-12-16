<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPlan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function task(){
        return $this->belongsTo(Task::class, "task_id");
    }
    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function servicePrice(){
        return $this->belongsTo(ServicePrice::class, 'service_price_id');
    }
    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }


}
