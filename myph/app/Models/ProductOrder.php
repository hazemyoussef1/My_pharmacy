<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable=['price',
    'quantity',
    'user_id',
    'product_id'],
    $table='product_orders';

    use HasFactory;

    public function user()
    {
        return $this->belongsToMany(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'product_id');
    }
}
