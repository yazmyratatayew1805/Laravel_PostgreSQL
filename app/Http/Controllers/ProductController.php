<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }


    public function store(Request  $request)
    {
        if(auth()->user()->admin == 1){

        $this->validate($request, [
            'article' => 'required|max:10',
            'name' => 'required|regex:/^[a-zA-Z]+$/u|unique:products'
        ]);

        Product::create($request->all());
        return back();
    }
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
