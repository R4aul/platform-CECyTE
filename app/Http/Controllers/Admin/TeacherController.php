<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TeacherController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('teachers.index'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('teachers.create'), only:['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('teachers.store'), only:['store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('teachers.edit'), only:['edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('teachers.update'), only:['update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::role(['Docente', 'Administrador'])->get();
        return view('admin.teachers.index', compact('teachers'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Semester::with('subjects')->get();
        return view('admin.teachers.create', compact('semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string'],
            'maternal_surname' =>['string'] ,
            'paternal_surname' =>['string'] ,
            'email' => ['string','email'],
            'subjects' => 'required|array',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'maternal_surname' => $request->maternal_surname,
            'paternal_surname' => $request->paternal_surname,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);
        
        $user->assignRole($request->role);
        $user->subjects()->attach($request->subjects);
        
        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $teacher)
    {
        $semesters = Semester::with('subjects')->get();
        return view('admin.teachers.edit', compact('teacher', 'semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name' => ['string'],
            'maternal_surname' =>['string'] ,
            'paternal_surname' =>['string'] ,
            'email' => ['required','string','email','max:255',"unique:users,email,{$teacher->id}"],
            'subjects' => 'required|array',
            'role' => 'required|exists:roles,name',
        ]);
        
        $teacher->name = $request->name;
        $teacher->paternal_surname = $request->paternal_surname;
        $teacher->maternal_surname = $request->maternal_surname;
        $teacher->email = $request->email;

        $teacher->update([
            'name' => $request->name,
            'maternal_surname' => $request->maternal_surname ,
            'paternal_surname' => $request->paternal_surname ,
            'email' => $request->email,
        ]);

        $teacher->syncRoles([$request->role]);
        
        $teacher->subjects()->sync($request->subjects);
        

        return redirect()->route('teachers.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        //
    }
}
