<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {


        $products = Product::with('user')->paginate(5);

//        return response()->json($products, 200);
        return view('products.index', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

}
