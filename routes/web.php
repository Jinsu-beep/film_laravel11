<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$movies = [];

for ($i=1; $i < 11; $i++) { 
    $movies[] = [
        'title' => 'Movie ' . $i,
        'description' => 'Description for movie ' . $i,
        'release_date' => now()->year,
    ];
}

Route::get('/movie/{id}', function ($id) use ($movies) {
    return $movies[$id];
});

Route::get('/movie', function () use ($movies) {

    return $movies;
});

Route::post('/movie', function () use ($movies) {

    // $movies[] = request()->all();

    $movies[] = [
        'title' => request('title'),
        'description' => request('description'),
        'release_date' => now()->year,
    ];

    return $movies; 
});

Route::put('/movie/{id}', function ($id) use ($movies) {

    // $movies[$id]['title'] = request('title');
    // $movies[$id]['description'] = request('description');
    // $movies[$id]['release_date'] = now();

    $movies[$id] = [
        'title' => request('title'),
        'description' => request('description'),
        'release_date' => now()->year,
    ];

    return $movies;

});

Route::patch('/movie/{id}', function ($id) use ($movies) {

    $movies[$id]['title'] = request('title');
    // $movies[$id]['description'] = request('description');
    // $movies[$id]['release_date'] = now();

    // $movies[$id] = [
    //     'title' => request('title'),
    //     'description' => request('description'),
    //     'release_date' => now(),
    // ];

    return $movies;

});

Route::delete('/movie/{id}', function ($id) use ($movies) {

    unset($movies[$id]);

    return $movies;

});