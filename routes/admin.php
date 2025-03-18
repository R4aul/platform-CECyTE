<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;

Route::resource('/teachers',TeacherController::class);

Route::resource('/students',StudentController::class);
