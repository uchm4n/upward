<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['all']);
    }

    public function all()
    {
        return Product::with('user:id,email')->orderBy('created_at', 'DESC')->paginate();
    }

    public function create(ProductRequest $request)
    {
        try {
            Product::create([
                'name'    => $request->get('name'),
                'year'    => $request->get('year'),
                'photo'   => $request->get('photo'),
                'user_id' => $request->user()->id,
            ]);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
        return response(['message' => 'Products was created'], 200);
    }

    public function update(ProductRequest $request)
    {
        try {
            $product = new Product();
            $product->find($request->get('id'))->update($request->all());
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
        return response(['message' => 'Products was updated'], 200);
    }


    public function destroy($id)
    {
        try {
            $product = new Product();
            $product->find($id)->delete();
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 500);
        }
        return response(['message' => 'Products was deleted'], 200);
    }


}
