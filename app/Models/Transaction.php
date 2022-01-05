<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'user_id',
        'quantity',
        'transaction_type'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
