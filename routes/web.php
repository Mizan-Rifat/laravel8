<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use Akaunting\Money\Money;
use Akaunting\Money\Currency;
use App\Models\Currency as ModelsCurrency;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('test');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Route::post('/test', function (Request $request) {
    $columns = [];

    foreach ($request->name as $i => $name) {
        $array = [
            'name'=>$name,
            'type'=>$request->type[$i],
            'nullable'=>$request->nullable[$i],
            'default'=>$request->default[$i]
        ];

        array_push($columns,$array);
    }

    $table['name'] = $request->table_name;
    $table['id'] = $request->id;
    $table['timestamps'] = $request->timestamps;
    $table['columns'] = $columns;

    $data = [
        'model_name'=>$request->model_name,
        'table'=>$table,
    ];

    return Artisan::call('crud:generator', ['data'=>$data]);
    return $table;

});



Route::get('/test', function () {

    $array = [
        0=>14,
        1=>2
    ];

    if(in_array(1,$array)){
        return 't';
    }else{
        return 'f';
    }

});

Auth::routes();

Route::group(['prefix'=>'admin'],function(){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/delete/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::post('/roles/bulkdelete', [App\Http\Controllers\RoleController::class, 'bulkDestroy'])->name('roles.bulkdestroy');


    Route::group(['prefix'=>'category'],function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
        Route::get('/show/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
        Route::get('/edit/{category}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/destroy/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
        Route::post('/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\CategoryController::class, 'bulkdestroy'])->name('category.bulkdestroy');
    });

    Route::group(['prefix'=>'product'],function(){
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
        
        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
        Route::get('/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
        Route::get('/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::get('/destroy/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
        Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::post('/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\ProductController::class, 'bulkdestroy'])->name('product.bulkdestroy');
    });

    
    Route::group(['prefix'=>'ingredient'],function(){
        Route::get('/', [App\Http\Controllers\IngredientController::class, 'index'])->name('ingredient.index');
        Route::get('/create', [App\Http\Controllers\IngredientController::class, 'create'])->name('ingredient.create');
        Route::get('/{ingredient}', [App\Http\Controllers\IngredientController::class, 'show'])->name('ingredient.show');
        Route::get('/edit/{ingredient}', [App\Http\Controllers\IngredientController::class, 'edit'])->name('ingredient.edit');
        Route::get('/destroy/{ingredient}', [App\Http\Controllers\IngredientController::class, 'destroy'])->name('ingredient.destroy');
        Route::post('/store', [App\Http\Controllers\IngredientController::class, 'store'])->name('ingredient.store');
        Route::post('/update', [App\Http\Controllers\IngredientController::class, 'update'])->name('ingredient.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\IngredientController::class, 'bulkdestroy'])->name('ingredient.bulkdestroy');
    });

    Route::group(['prefix'=>'addableitem'],function(){
        Route::get('/', [App\Http\Controllers\AddableItemController::class, 'index'])->name('addableitem.index');
        Route::get('/create', [App\Http\Controllers\AddableItemController::class, 'create'])->name('addableitem.create');
        Route::get('/{addableitem}', [App\Http\Controllers\AddableItemController::class, 'show'])->name('addableitem.show');
        Route::get('/edit/{addableitem}', [App\Http\Controllers\AddableItemController::class, 'edit'])->name('addableitem.edit');
        Route::get('/destroy/{addableitem}', [App\Http\Controllers\AddableItemController::class, 'destroy'])->name('addableitem.destroy');
        Route::post('/store', [App\Http\Controllers\AddableItemController::class, 'store'])->name('addableitem.store');
        Route::post('/update', [App\Http\Controllers\AddableItemController::class, 'update'])->name('addableitem.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\AddableItemController::class, 'bulkdestroy'])->name('addableitem.bulkdestroy');
    });
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




