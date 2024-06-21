<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('index');
    // $value = session()->all();
    // echo "<pre>";
    // print_r($value);
    // echo "</pre>";
})->name('index');

?>
