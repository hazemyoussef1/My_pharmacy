<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Order extends Model
{
    protected $fillable=['id_ph'],
    $table='orders';

    use HasFactory;
    public function pharamcy ()
    {
        return $this->belongsTo(Pharmacy::class,'id_ph');
    }
    public function orderdetail()
    {
        return $this->belongsToMany(OrderDetail::class,);
    }

}
