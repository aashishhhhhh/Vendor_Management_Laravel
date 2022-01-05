<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name',
        'quantity'
    ];
    use HasFactory;
    public function categories()
    {
        return $this->hasMany(Category::class,'category_products');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    
}
