<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel',function(){
    return view('students.panel-alumnos');
})->name('panel.alumnos');;