<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OperationsController;

Route::get('/', function () {
    return view('welcome');
});
    

Route::get('countAllNumbersBetween/{sn}/{en}', [OperationsController::class, 'countAllNumbersBetween']);


Route::get('returnIndexString/{input_string}', [OperationsController::class, 'returnIndexString']);

