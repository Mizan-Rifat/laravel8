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
use App\Http\Requests\ProductRequest;
use App\Models\AddableItem;
use App\Models\Currency as ModelsCurrency;
use App\Models\NutritionalItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

    return view('admin.test');
});
Route::get('admin/crud', function () {
    return view('admin.crud.crud');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Route::post('/crud', function (Request $request) {
    $columns = [];
    $table = [];

    $fields['migration'] = $request->migration;
    $fields['model'] = $request->model;
    $fields['controller'] = $request->controller;
    $fields['formRequest'] = $request->formRequest;
    $fields['routes'] = $request->routes;
    $fields['permissions'] = $request->permissions;

    // return $request;

    if($request->migration){

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
    }

    $data = [
        'model_name'=>$request->model_name,
        'table'=>$table,
        'fields'=>$fields,
    ];

    return Artisan::call('crud:generator', ['data'=>$data]);
    return $table;

});



Route::get('/test', function () {

    return AddableItem::find(1);

   return get_gate_action('Category','create');

});

Route::post('/test', [App\Http\Controllers\HomeController::class,'test'])->name('test');

Auth::routes();

Route::group(['prefix'=>'admin'],function(){

    Route::get('/test', function () {

        return view('admin.test');
    
    });
    
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('admin.profile');
    Route::get('/profile/change_password', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.password_change');
    Route::post('/profile/change_avatar/{user}', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.update_avatar');

    Route::group(['prefix'=>'user'],function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::get('/show/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::get('/destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::post('/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\UserController::class, 'bulkdestroy'])->name('users.bulkdestroy');
        Route::post('/removeimage/{user}', [App\Http\Controllers\ProfileController::class, 'removeImage'])->name('users.removeimage');
    });



    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/delete/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::post('/roles/bulkdelete', [App\Http\Controllers\RoleController::class, 'bulkDestroy'])->name('roles.bulkdestroy');


    Route::group(['prefix'=>'category'],function(){
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/edit/{category}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::get('/destroy/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::post('/update/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\CategoryController::class, 'bulkdestroy'])->name('categories.bulkdestroy');
        Route::get('/{category}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
    });

    Route::group(['prefix'=>'product'],function(){
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        
        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::get('/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
        Route::get('/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::get('/destroy/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
        Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::post('/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
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
        Route::post('/update/{ingredient}', [App\Http\Controllers\IngredientController::class, 'update'])->name('ingredients.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\IngredientController::class, 'bulkdestroy'])->name('ingredients.bulkdestroy');
    });

    Route::group(['prefix'=>'addableitem'],function(){
        Route::get('/', [App\Http\Controllers\AddableItemController::class, 'index'])->name('addableitems.index');
        Route::get('/create', [App\Http\Controllers\AddableItemController::class, 'create'])->name('addableitems.create');
        Route::get('/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'show'])->name('addableitems.show');
        Route::get('/edit/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'edit'])->name('addableitems.edit');
        Route::get('/destroy/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'destroy'])->name('addableitems.destroy');
        Route::post('/store', [App\Http\Controllers\AddableItemController::class, 'store'])->name('addableitems.store');
        Route::post('/update/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'update'])->name('addableitems.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\AddableItemController::class, 'bulkdestroy'])->name('addableitems.bulkdestroy');
        Route::post('/removeimage/{addableItem}', [App\Http\Controllers\AddableItemController::class, 'removeImage'])->name('addableitems.removeimage');
    });

    Route::group(['prefix'=>'permission'],function(){
        Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissions.create');
        Route::get('/show/{permission}', [App\Http\Controllers\PermissionController::class, 'show'])->name('permissions.show');
        Route::get('/edit/{permission}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
        Route::get('/destroy/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::post('/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
        Route::post('/update/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\PermissionController::class, 'bulkdestroy'])->name('permissions.bulkdestroy');
    });
    
    Route::group(['prefix'=>'nutritionalitem'],function(){
        Route::get('/', [App\Http\Controllers\NutritionalItemController::class, 'index'])->name('nutritionalitems.index');
        Route::get('/create', [App\Http\Controllers\NutritionalItemController::class, 'create'])->name('nutritionalitems.create');
        Route::get('/show/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'show'])->name('nutritionalitems.show');
        Route::get('/edit/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'edit'])->name('nutritionalitems.edit');
        Route::get('/destroy/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'destroy'])->name('nutritionalitems.destroy');
        Route::post('/store', [App\Http\Controllers\NutritionalItemController::class, 'store'])->name('nutritionalitems.store');
        Route::post('/update/{nutritionalItem}', [App\Http\Controllers\NutritionalItemController::class, 'update'])->name('nutritionalitems.update');
        Route::post('/bulkdestroy', [App\Http\Controllers\NutritionalItemController::class, 'bulkdestroy'])->name('nutritionalitems.bulkdestroy');
    });

    Route::group(['prefix'=>'product/nutritionalvalue'],function(){
        Route::get('/edit/{product}', [App\Http\Controllers\NutritionalValueController::class, 'edit'])->name('nutritionalvalues.edit');
        Route::post('/update/{product}', [App\Http\Controllers\NutritionalValueController::class, 'update'])->name('nutritionalvalues.update');
    });



   
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
