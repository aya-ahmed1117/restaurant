<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = [];

    // connect between orders & (users / meals)
    public function order_user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function order_meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
}
