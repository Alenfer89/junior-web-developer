<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentsController;

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

Route::post('components/clean-me', [ComponentsController::class, 'clean_me']);
Route::get('components', [ComponentsController::class, 'index']);
Route::post('components', [ComponentsController::class, 'store']);

