<?php

use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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
    return view('welcome');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::group(['middleware'=>'auth:sanctum','verified'],function(){
    Route::resource('dashboard',DashboardController::class);
    Route::resource('business', BusinessController::class);
    Route::resource('account', AccountController::class);
    Route::resource('branch',BranchController::class);
    Route::resource('product',ProductController::class);
    Route::resource('employees',EmployeeController::class);
    Route::resource('transaction',TransactionController::class);
    //Route for adding a product
    Route::get('prod-form/{id}',[ProductController::class,'addProd'])->name('prodForm');
    //Route for deleting a product
    Route::delete('delete/{id}',[ProductController::class,'delete'])->name('delete');
    //Route for product quantity upadating form
    Route::get('Update-Quantity-Page/{id}',[ProductController::class,'updtQtyPage'])->name('updtQtyPage');
    //Route for updating product quantity
    Route::post('Update-Quantity',[ProductController::class,'updateQty'])->name('updateQty');

});
