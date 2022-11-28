<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('admin')->group(function () {
        Route::resource('makanan', MakananController::class)->except(
            ['create', 'edit']
        );
        Route::resource('minuman', MinumanController::class)->except(
            ['create', 'edit']
        );
        Route::get('/akun-user', [AuthController::class, 'alluser']);
        Route::get('/akun-user/{id}', [AuthController::class, 'showuser']);
    });
    Route::prefix('user')->group(function () {
        Route::resource('pemesanan', PemesananController::class)->except(
            ['create', 'edit']
        );
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('makanan', [MakananController::class, 'index']);
Route::get('makanan/{id}', [MakananController::class, 'show']);

Route::get('minuman', [MinumanController::class, 'index']);
Route::get('minuman/{id}', [MinumanController::class, 'show']);

Route::get('pemesanan', [PemesananController::class, 'index']);
Route::get('pemesanan/{id}', [PemesananController::class, 'show']);
