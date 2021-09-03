<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    /**
     * Get the user that owns the Product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
