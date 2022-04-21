<?php

use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\EquipmentTypeController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(EquipmentController::class)
    ->middleware('auth:sanctum')
    ->prefix('equipment')
    ->name('equipment.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::put('/', 'storeMany')->name('storeMany');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'delete')->name('delete');
    });
Route::controller(EquipmentTypeController::class)
    ->middleware('auth:sanctum')
    ->prefix('equipment-types')
    ->name('equipment.types')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

// the code bellow is created for demonstration purposes
Route::post('/token/new', [TokenController::class, 'new'])->name('token.new');
