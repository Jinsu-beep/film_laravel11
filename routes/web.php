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

Route::group(['middleware' => ['isAuth'], 'prefix' => 'movie', 'as' => 'movie.'], function () use ($movies) {
    Route::get('/', function () use ($movies) {
        return $movies;
    });

    Route::get('/{id}', function ($id) use ($movies) {
        return $movies[$id];
    })->middleware('isMember');
    
    Route::post('/', function () use ($movies) {
    
        // $movies[] = request()->all();
    
        $movies[] = [
            'title' => request('title'),
            'description' => request('description'),
            'release_date' => now()->year,
        ];
    
        return $movies; 
    });
    
    Route::put('/{id}', function ($id) use ($movies) {
    
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
    
    Route::patch('/{id}', function ($id) use ($movies) {
    
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
    
    Route::delete('/{id}', function ($id) use ($movies) {
    
        unset($movies[$id]);
    
        return $movies;
    
    });
});



Route::get('/pricing', function () {
    return 'please, buy a membership!';
});

Route::get('/login', function () {
    return 'login page';
})->name('login');