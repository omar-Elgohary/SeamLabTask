<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OperationsController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


############################################# Part 1 #################################################
Route::get('countAllNumbersBetween/{sn}/{en}', [OperationsController::class, 'countAllNumbersBetween']);

Route::get('returnIndexString/{letters}', [OperationsController::class, 'returnIndexString']);




############################################# Part 2 #################################################
Route::group(['middleware' => 'api', 'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/getUserById/{id}', [AuthController::class, 'getUserById']);
    Route::get('/getAllUsers', [AuthController::class, 'getAllUsers']);

    Route::put('/updateUser/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/deleteUser/{id}', [AuthController::class, 'deleteUser']);

    Route::post('/logout', [AuthController::class, 'logout']);
});



