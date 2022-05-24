<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   
});


// All Listings
Route::get('/', [ListingController::class,'index']);

// Show Create Show
Route::get('/listings/create',[ListingController::class,'create'])->middleware('auth');

// Store new Listing data
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');

// Update a Listing
Route::put('/listings/{listing}',[ListingController::class,'update'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit',[ListingController::class,'edit'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

// Manage Listing
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{listing}',[ListingController::class,'show']);

// Show Register Form
Route::get('/register',[UserController::class,'register'])->middleware('guest');

// Show Login Form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

// Log User Out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

// Create new user
Route::post('/users',[UserController::class,'store']);

// Log User In
Route::post('/users/authenticate',[UserController::class,'authenticate']);

