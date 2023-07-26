<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this ->belongsTo(Category::class, 'id_category','id');
    }

    public function subcategory() {
        return $this ->belongsTo(Subcategory::class, 'id_subcategory','id');
    }

    public function cart(){
        return $this ->hasMany(Cart::class);
    }
}
