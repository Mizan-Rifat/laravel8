<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index')->with('products',$products);
    }

    public function store(ProductRequest $request)
    {
        

        $images = [];
        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('products');
                array_push($images,"images/products/".$file->hashName());
            }
        }

        $product = Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category,
            'description'=>$request->description,
            'price'=>$request->price,
            'active'=>$request->active == 'on' ? 1 : 0,
            'image'=>json_encode($images),
        ]);

        return redirect()->route('product.index')->with('message', 'Created Successfully!');
    }

    public function show(Product $product)
    {

        $product->load('category');

        return $product;
        return view('admin.products.show')->with('product',$product);
    }
    
    public function edit(Product $product)
    {

        $categories = Category::get(['id','name']);

        return view('admin.products.add-edit',compact(
            'product',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::get(['id','name']);
        return view('admin.products.add-edit',compact(
            'categories'
        ));
    }

    public function update(ProductRequest $request)
    {


        $product = Product::findOrFail($request->id);


        $productImages = json_decode($product->image);

        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('products');
                array_push($productImages,"images/products/".$file->hashName());
            }
        }

        $product->update([
            'name'=>$request->name,
            'category_id'=>$request->category,
            'description'=>$request->description,
            'price'=>$request->price,
            'active'=>$request->active == 'on' ? 1 : 0,
            'image'=>json_encode($productImages),
        ]);
        

        return redirect()->route('product.index')->with('message', 'Updated Successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){


        Product::destroy($request->ids);
        return redirect()->route('product.index')->with('message', 'Deleted Successfully!');
    }
}