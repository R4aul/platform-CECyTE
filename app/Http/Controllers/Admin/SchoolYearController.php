<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolYear;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SchoolYearController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('schoolYears.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('schoolYears.create'), only: ['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('schoolYears.store'), only: ['store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('schoolYears.edit'), only: ['edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('schoolYears.update'), only: ['update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolYears = SchoolYear::all();
        return view('admin.schoolYears.index', compact('schoolYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schoolYears.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'name'=>['required','string'],
            'start_date'=>['required','date'],
            'final_date'=>['required','date'],
            'active'=>['nullable','boolean']
        ]);
    
        SchoolYear::create($request->all());
        
        return redirect()->route('schoolYears.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolYear $schoolYear)
    {
        return view('admin.schoolYears.show',compact('schoolYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('admin.schoolYears.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {

        $request->validate([
            'name'=>['required','string'],
            'start_date'=>['required','date'],
            'final_date'=>['required','date'],
            'active'=>['nullable','boolean']
        ]);
    
        $schoolYear->update($request->all());
        
        return redirect()->route('schoolYears.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolYear $schoolYear)
    {
        //
    }
}
