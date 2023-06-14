<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Warehouse extends Authenticatable
{
       /**
     * Summary of table
     * @var string
     */
    protected $fillable=['name','email','password','city','street','phone'],
    $table='warehouses';
    use HasApiTokens , HasFactory, Notifiable;
    protected $hidden = [
        'password',
        'remember_token',
    ];
/**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function medicine()
    {
        return $this->hasMany(Medicine::class);
    }
}
