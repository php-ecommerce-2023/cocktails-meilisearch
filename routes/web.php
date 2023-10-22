<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\CocktailFinder::class);

Route::get('search', function () {
    return \App\Models\Cocktail::search(
        'hangover',
        function (\Meilisearch\Endpoints\Indexes $meilisearch, $query, $options) {
            $options['facets'] = ['tags', 'category'];
            return $meilisearch->search($query, $options);
        }
    )->raw();
});
