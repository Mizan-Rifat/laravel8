<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NutritionalItem;
use App\Models\Product;
use Illuminate\Http\Request;

class NutritionalValueController extends Controller
{
    public function edit(Product $product){
        $nutritionalItems = NutritionalItem::all();
        $product->load('nutritionalValues');

        return view('admin.products.product-next')->with([
            'product' => $product,
            'nutritionalItems' => $nutritionalItems,
        ]);
    }

    public function update(Request $request,Product $product){

        $product->nutritionalValues()->sync(json_decode($request->nutritionalValues,true));
        return redirect()->route('products.index')->with('message', 'Updated Successfully!');
    }
}
