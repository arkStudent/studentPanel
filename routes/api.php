<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendController;
use App\Http\Controllers\ArkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





// Route::post('/login', [ArkController::class, 'login'])->name('login');
Route::middleware(['web'])->group(function () {
    Route::post('/login', [ArkController::class, 'login'])->name('login');
    //Lubna called routes start
    Route::get('/attendForm', [AttendController::class, 'index'])->name('attend.index');
    
});