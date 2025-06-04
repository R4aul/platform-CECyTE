<?php

namespace App\Http\Controllers\Admin;

use App\Models\Qualification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Partial;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class QualificationController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.create'), only: ['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.store'), only: ['store']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $alumnos = User::whereHas("roles", function($q) {
            $q->where("name", "Alumno");
        })
        ->when($search, function ($query, $search) {
            $query->where('matriculation', 'like', '%' . $search . '%');
        })
        ->with(['qualifications.subject', 'qualifications.partial'])->get();

        $materias = Subject::with('semester')->get();
        $parciales = Partial::where('active', true)->get();

        return view('admin.qualifications.index', compact('alumnos', 'materias', 'parciales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $alumno = User::findOrFail($request->alumno_id);
        $materias = Subject::where('semester_id', $request->semestre_id)->get();
        $parcial = Partial::where('id', $request->parcial_id)->firstOrFail();

        return view('admin.qualifications.create', compact('alumno', 'materias', 'parcial'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'parcial_id' => 'required|exists:partials,id',
            'calificaciones' => 'required|array',
            'calificaciones.*.materia_id' => 'required|exists:subjects,id',
            'calificaciones.*.calificacion' => 'required|numeric|min:0|max:10',
        ]);

        foreach ($request->calificaciones as $entrada) {
            Qualification::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'partial_id' => $request->parcial_id,
                    'subject_id' => $entrada['materia_id'],
                ],
                [
                    'grade' => $entrada['calificacion'],
                ]
            );
        }

        return redirect()->route('qualifications.index')->with('success', 'Calificaciones asignadas correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualification $qualification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        //
    }
}
