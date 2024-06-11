<?php

use App\Http\Controllers\JsonController;

Route::get('/json', [JsonController::class, 'index']);
// Route::get('/json', 'JsonController@index')->name('json.index');
