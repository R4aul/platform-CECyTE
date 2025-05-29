<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\Admin\ChangeGradeController;
use App\Http\Controllers\Admin\QualificationController;
use App\Http\Controllers\Admin\TaskController;

Route::resource('/teachers',TeacherController::class)
    ->except(['show'])
    ->middleware('auth');

Route::resource('/students',StudentController::class)
    ->middleware('auth');

Route::prefix('materials')->controller(MaterialController::class)->group(function(){
    Route::get('/{subject}','index')->name('materials.index');
    Route::post('/{subject}','store')->name('materials.store');
    Route::get('/{material}/show','show')->name('materials.show');
    Route::get('/{material}/edit','edit')->name('materials.edit');
    Route::put('/{material}/update','update')->name('materials.update');
    Route::delete('/{material}/destroy','destroy')->name('materials.destroy');
    Route::get('create/{subject}','create')->name('materials.create');
})->middleware('auth');

Route::resource('/subjects', SubjectController::class)
    ->except(['create','store','show','destroy',])
    ->middleware(['auth']);

Route::resource('/schoolYears',SchoolYearController::class)->except(['destroy','show'])
    ->middleware('auth');

Route::get('/semesters',[ChangeGradeController::class,'index'])
    ->middleware('auth')
    ->name('semester.index');

Route::post('/semesters/advanceStudent/{id}',[ChangeGradeController::class,'advanceStudent'])
    ->middleware('auth')
    ->name('semester.advanceStudent');

Route::get('/createStudents',function()  {
    return view('admin.register.create');    
})->name('register.students')->middleware('auth');

Route::resource('qualifications',QualificationController::class)
    ->except(['destroy','show','edit','update'])
    ->middleware('auth');

Route::prefix('admin')->controller(TaskController::class)->group(function(){
    Route::get('/{material}/tasks','index')->name('admin.tasks.index');
    Route::get('/taks/{task}/show', 'show')->name('admin.tasks.show');
});