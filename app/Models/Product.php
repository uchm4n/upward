<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['created_at' => 'datetime:Y-m-d H:i:s',];

    /**
     * Get the user that owns the Product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
