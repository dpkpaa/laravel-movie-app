<?php

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/movies', 301);
});
Route::resource('movies', 'MoviesController')->only(['index', 'show']);
Route::resource('actors', 'ActorsController')->only(['index', 'show']);
Route::resource('tv', 'TvController')->only(['index', 'show']);

Route::get('/test', function () {

    Redis::set('test', User::all());
    return Redis::get('test');
});
