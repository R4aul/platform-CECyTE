<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::role('Alumno')->get();
        return view('admin.students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'maternal_surname' => ['required','string'],
            'paternal_surname' => ['required', 'string'],
            'matriculation' => ['required', 'string', 'max:14'],
            'email' => ['required','string', 'email'],
            'password' => ['required','string'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'maternal_surname' => $request->maternal_surname,
            'paternal_surname' => $request->paternal_surname,
            'matriculation' => $request->matriculation,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $user->assignRole('Alumno');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        return view('admin.students.show', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        $request->validate([
            'name' => ['required','string'],
            'maternal_surname' => ['required','string'],
            'paternal_surname' => ['required', 'string'],
            'matriculation' => ['required', 'string', 'max:14'],
            'email' => ['required','string', 'email'],
        ]);
        $student->update([
            'name' => $request->name,
            'maternal_surname' => $request->maternal_surname,
            'paternal_surname' => $request->paternal_surname,
            'matriculation' => $request->matriculation,
            'email' => $request->email,
        ]);
    
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        //
    }
}
