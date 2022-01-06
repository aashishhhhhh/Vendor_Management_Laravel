<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/showtransactedProduct',[TransactionController::class,'showtransactedProduct']);
Route::get('/',[UserController::class,'loginForm']);   
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout']);
Route::get('/showList',[UserController::class,'showList']);


Route::group(["middleware" => ["protectPage"]], function(){
    Route::get('/showAddUser',[UserController::class,'showAddUser']);
    Route::post('addUser',[UserController::class,'addUser']);
    Route::get('/showedit/{id}',[UserController::class,'showedit']);
    Route::post('/editUser',[UserController::class,'editUser']);
    Route::get('deleteUser/{id}',[UserController::class,'deleteUser']);
    Route::get('/showAddCategory',[CategoryController::class,'showAddCategory']);
    Route::post('addCategory',[CategoryController::class,'addCategory']);
    Route::get('showAddProduct',[ProductController::class,'showAddProduct']);
    Route::post('addProduct',[ProductController::class,'addProduct']);
    Route::get('/showCategoryList',[CategoryController::class,'showCategoryList']);
    Route::get('/showCategoryedit/{id}',[CategoryController::class,'showCategoryedit']);
    Route::post('/editCategory',[CategoryController::class,'editCategory']);
    Route::get('/deleteCategory/{category}',[CategoryController::class,'deleteCategory']);
    Route::get('/showProductList',[ProductController::class,'showProductList']);
    Route::get('/showProductedit/{id}',[ProductController::class,'showProductedit']);
    Route::post('/editProduct',[ProductController::class,'editProduct']);
    Route::get('/deleteProduct/{id}',[ProductController::class,'deleteProduct']);
    Route::get('/showQuantityAdd/{id}',[ProductController::class,'showQuantityAdd']);
    Route::post('/quantityAdd',[ProductController::class,'quantityAdd']);
    Route::get('/showAssignProduct/{id}',[ProductController::class,'showAssignProduct']);
    Route::post('/assignProduct',[ProductController::class,'assignProduct']);
    Route::post('/ showTransaction',[TransactionController::class,'showTransaction']);
    Route::get('/filterTransaction',[TransactionController::class,'filterTransaction']);
    Route::get('/showCategoryProducts/{id}',[ProductController::class,'showCategoryProducts']);

});




