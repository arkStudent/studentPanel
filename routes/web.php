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

Route::get('/logout', function (Request $request) {
    $request->session()->forget(['student_id', 'student_name']);
    return redirect('/');
})->name('logout');

Route::get('/sigin', function () {
    // return view('signup');
    $value = session()->get('student_id');
    echo "<pre>";
    print_r($value);
    echo "</pre>";
})->name('signin');


Route::get('/attendTable', function () {
    return view('attendTable');
})->name('attendTable');

?>
