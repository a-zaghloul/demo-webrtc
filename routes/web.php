<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('camera');
});


Route::get('/camera', function () {
    return view('camera');
});

Route::get('/audio', function () {
    return view('audio');
});

Route::get('/video', function () {
    return view('video');
});
