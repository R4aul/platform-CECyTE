<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\MaterialController;

Route::resource('/teachers',TeacherController::class);

Route::resource('/students',StudentController::class);

Route::prefix('materials')->controller(MaterialController::class)->group(function(){
    Route::get('/{subject}','index')->name('materials.index');
    Route::post('/{subject}','store')->name('materials.store');
    Route::get('create/{subject}','create')->name('materials.create');
});
