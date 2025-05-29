<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\PanelCotroller;
use App\Http\Controllers\Student\TaskController;
use App\Http\Controllers\Student\QualificationsController;

Route::get('/panel',[PanelCotroller::class,'index'])
    ->middleware(['auth'])
    ->name('panel.alumnos');

Route::get('/students/{material}/task',[TaskController::class,'create'])
    ->name('students.task.create')
    ->middleware('auth');

Route::post('/students/{material}/task/store',[TaskController::class,'store'])
    ->name('students.task.store')
    ->middleware('auth');


Route::controller(QualificationsController::class)->group(function(){
    Route::get('students/qualifications','index')->name('students.qualifications.index');
})->middleware('auth');