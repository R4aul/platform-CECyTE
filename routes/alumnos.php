<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\PanelCotroller;
use App\Http\Controllers\Student\TaskController;

Route::get('/panel',[PanelCotroller::class,'index'])->middleware(['auth'])->name('panel.alumnos');

Route::get('/students/{material}/task',[TaskController::class,'create'])->name('students.task.create')->middleware('auth');
