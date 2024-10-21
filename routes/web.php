<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HrRouteController;

Route::get('/', function () {
    return view('welcome');
});

//route resource for Hrs
Route::resource('/hr', HrRouteController::class);
Route::get('/hrpdf', [HrRouteController::class, 'pdf'])->name('hr.pdf');
