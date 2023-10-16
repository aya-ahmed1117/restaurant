<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\visitorController;
use App\Http\Controllers\CategoryControl;
use App\Http\Controllers\mealController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*

Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/' , [visitorController::class,'index'])->name('vPAge');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//userPage.blade.php


//category
Route::get('/category/', [CategoryControl::class, 'shows'])->name('cat.shows');

/// add cat
route::post('/category/store' , [CategoryControl::class, 'store'])->name('cat.store');

//delete category
route::get('/category/{id}',[CategoryControl::class,'delete'])->name('cat.delete');

//update
Route::post('/category/update',[CategoryControl::class, 'update'])->name('cat.update');

// get new page MEALS
route::get('/meal/create_meal',[mealController::class , 'create'])->name('create_meal');
//add meal
route::POST('meal/store',[mealController::class , 'store'])->name('meal.store');

// index meal
  route::get('/meal/show' , [mealController::class, 'index'])->name('meal.index');
//update meal
  Route::get('/meal/update/{id}' , [mealController::class ,'update'])->name('meal.update');
  //edit meal
  route::post('/meal/edit/{id}',[mealController::class ,'edit'])->name('meal.edit');

  // delete meal
  route::get('/meal/delete/{id}' , [mealController::class,'delete'])->name('meal.delete');

  //meal_details 
  route::get('/meal/shows/{id}',[mealController::class,'meal_details'])->name('meal_details');
  //add order
	  Route::post('/order/store/' , [HomeController::class,'order_store'])->name('order.store');

	  route::get('/order/show',[HomeController::class,'show_order']);
	  route::get('/home/show',[HomeController::class,'show_Huser']);
	  //status
	  route::post('/order/status/{id}', [HomeController::class,'changeStatus'])->name('order.status');



