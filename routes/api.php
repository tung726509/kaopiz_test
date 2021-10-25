<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/get-list-users', function (Request $request) {
//     dd(Str::random(80));
//     return $request->user();
// })->name('api.users');

Route::middleware('auth:api')->get('/get-list-users', function (Request $request) {
    // api_token
    return $request->user();
})->name('api.users');

