<?php

namespace App\Models;

use App\Http\Controllers\SubcategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategory() {
        return $this ->hasMany(Subcategory::class);
    }

    public function product() {
        return $this ->hasMany(Product::class);
    }
}
