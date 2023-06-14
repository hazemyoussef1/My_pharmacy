<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable=['name','image','mg','exp','price_pharmacy','price_customer','composition','quantity','warehouse_id','category_id'],
    $table='medicines';
    use HasFactory;
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
