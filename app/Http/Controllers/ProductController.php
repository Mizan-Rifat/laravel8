<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\AddableItem;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\NutritionalItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        Gate::authorize(get_gate_action('Product','browse'));

        $dataType = 'product';
        $data = Product::with('category','ingredients','addableItems','nutritionalValues')->get();
// return $data;
        return view('admin.bread.index',compact(
            'data',
            'dataType'
        ));
    }

    public function store(ProductRequest $request)
    {
        Gate::authorize(get_gate_action('Product','create'));

        $images = [];
        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('products');
                array_push($images,"images/products/".$file->hashName());
            }
        }

        $product = Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'price'=>$request->price,
            'active'=>$request->active == 'on' ? 1 : 0,
            'image'=>json_encode($images),
        ]);

        $product->ingredients()->sync($request->ingredients);
        $product->addableItems()->sync($request->addableItems);

        return redirect()->route('nutritionalvalues.edit',['product'=>$product->id]);

        return redirect()->route('products.index')->with('message', 'Created Successfully!');
    }

    public function show(Product $product)
    {
        Gate::authorize(get_gate_action('Product','read'));

        $product->load('category','nutritionalValues');
        $dataType = 'product';
        $data = $product;

        // return $product;

        return view('admin.bread.show',compact(
            'data',
            'dataType'
        ));
    }
    
    public function edit(Product $product)
    {
        Gate::authorize(get_gate_action('Product','update'));

        $product->load('category','ingredients','addableItems','nutritionalValues');
        
        $dataType = 'product';
        $data = $product;


    
        $categories = Category::get(['id','name']);
        $ingredients = Ingredient::get(['id','name']);
        $addableItems = AddableItem::all();
        $nutritionalItems = NutritionalItem::all();
  
        return view('admin.bread.add-edit',compact(
            'data',
            'dataType',
            'categories',
            'ingredients',
            'addableItems',
            'nutritionalItems',

        ));
    }

    public function create()
    {
        Gate::authorize(get_gate_action('Product','create'));

        $dataType='product';
        $categories = Category::get(['id','name']);
        $ingredients = Ingredient::get(['id','name']);
        $addableItems = AddableItem::all();

        return view('admin.bread.add-edit',compact(
            'dataType',
            'categories',
            'ingredients',
            'addableItems',
        ));
    }

    public function update(ProductRequest $request,Product $product)
    {
        Gate::authorize(get_gate_action('Product','update'));

        $productImages = $product->image == null ? [] : json_decode($product->image);

        if($files=$request->file('images')){
            foreach($files as $file){
                $file->store('products');
                array_push($productImages,"images/products/".$file->hashName());
            }
        }

        $product->ingredients()->sync($request->ingredients);
        $product->addableItems()->sync($request->addableItems);

        $product->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'price'=>$request->price,
            'active'=>$request->active == 'on' ? 1 : 0,
            'image'=>json_encode($productImages),
        ]);
        

        return redirect()->route('nutritionalvalues.edit',['product'=>$product->id]);
    }

    public function destroy(Product $product)
    {
        Gate::authorize(get_gate_action('Product','delete'));

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');

    }


    public function bulkDestroy(Request $request){

        Gate::authorize(get_gate_action('Product','delete'));

        Product::destroy($request->ids);
        return redirect()->route('products.index')->with('message', 'Deleted Successfully!');
    }

    public function removeImage(Product $product,Request $request){

        Gate::authorize(get_gate_action('Product','update'));

        $images = json_decode($product->image);

        if (($key = array_search($request->image, $images)) !== false) {
            unset($images[$key]);
        }


        $product->update([
            'image'=>json_encode(array_values($images)),
        ]);

        Storage::delete(str_replace("images/","",$request->image));

        return response()->json([
            'message' => 'Image removed successfully'
        ],200);
    }
}