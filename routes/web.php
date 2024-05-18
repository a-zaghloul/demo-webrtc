<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/camera', function () {
    return view('camera');
});

Route::get('/mic', function () {
    return view('mic');
});

Route::get('/video', function () {
    return view('video');
});
