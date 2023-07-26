<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticateble;

class Member extends Authenticateble
{
    use HasFactory;
    protected $guarded = [];
    
    public function order(){
        return $this ->hasMany(Order::class);
    }

    public function cart(){
        return $this ->hasMany(Cart::class);
    }
}
