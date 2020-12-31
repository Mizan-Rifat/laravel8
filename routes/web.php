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
use Illuminate\Support\Facades\Storage;

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

    return pluralDatatype('AddableItem');

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
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/show/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/edit/{category}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::get('/destroy/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::post('/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\CategoryController::class, 'bulkdestroy'])->name('categories.bulkdestroy');
    });

    Route::group(['prefix'=>'product'],function(){
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        
        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::get('/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
        Route::get('/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::get('/destroy/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
        Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::post('/update', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\ProductController::class, 'bulkdestroy'])->name('products.bulkdestroy');
        Route::post('/removeimage/{product}', [App\Http\Controllers\ProductController::class, 'removeImage'])->name('products.removeimage');
    });

    
    Route::group(['prefix'=>'ingredient'],function(){
        Route::get('/', [App\Http\Controllers\IngredientController::class, 'index'])->name('ingredients.index');
        Route::get('/create', [App\Http\Controllers\IngredientController::class, 'create'])->name('ingredients.create');
        Route::get('/{ingredient}', [App\Http\Controllers\IngredientController::class, 'show'])->name('ingredients.show');
        Route::get('/edit/{ingredient}', [App\Http\Controllers\IngredientController::class, 'edit'])->name('ingredients.edit');
        Route::get('/destroy/{ingredient}', [App\Http\Controllers\IngredientController::class, 'destroy'])->name('ingredients.destroy');
        Route::post('/store', [App\Http\Controllers\IngredientController::class, 'store'])->name('ingredients.store');
        Route::post('/update', [App\Http\Controllers\IngredientController::class, 'update'])->name('ingredients.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\IngredientController::class, 'bulkdestroy'])->name('ingredients.bulkdestroy');
    });

    Route::group(['prefix'=>'addableitem'],function(){
        Route::get('/', [App\Http\Controllers\AddableItemController::class, 'index'])->name('addableitems.index');
        Route::get('/create', [App\Http\Controllers\AddableItemController::class, 'create'])->name('addableitems.create');
        Route::get('/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'show'])->name('addableitems.show');
        Route::get('/edit/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'edit'])->name('addableitems.edit');
        Route::get('/destroy/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'destroy'])->name('addableitems.destroy');
        Route::post('/store', [App\Http\Controllers\AddableItemController::class, 'store'])->name('addableitems.store');
        Route::post('/update', [App\Http\Controllers\AddableItemController::class, 'update'])->name('addableitems.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\AddableItemController::class, 'bulkdestroy'])->name('addableitems.bulkdestroy');
        Route::post('/removeimage/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'removeImage'])->name('addableitems.removeimage');
    });
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


