<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all()
    {


        return Product::with('user:id,email')->paginate();

    }
}
