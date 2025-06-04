<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ChangeGradeController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('semesters.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('semesters.advanceStudent'), only: ['advanceStudent']),
        ];
    }

    public function index()
    {
        $cicloActivo = SchoolYear::where('active', true)->first();

        $alumnos = User::role('Alumno')->has('inscriptions')->with(['inscriptionsActive.semester'])->get();
        return view('admin.grades.index', compact('cicloActivo', 'alumnos'));
    }
    public function advanceStudent($id)
    {
        DB::beginTransaction();

        try {
            $alumno = User::findOrFail($id);
            $registroActual = $alumno->inscriptionsActive;

            if (!$registroActual) {
                return back()->with('error', 'El alumno no tiene un semestre activo.');
            }

            $cicloActivo = SchoolYear::where('active', true)->first();
            if (!$cicloActivo) {
                return back()->with('error', 'No hay ciclo escolar activo.');
            }

            $semestreActualId = $registroActual->semester_id;
            $siguienteSemestre = Semester::where('id', '>', $semestreActualId)->orderBy('id')->first();

            if (!$siguienteSemestre) {
                return back()->with('error', 'El alumno ya está en el último semestre.');
            }

            $registroActual->update(['active' => false]);

            Registration::create([
                'user_id' => $alumno->id,
                'semester_id' => $siguienteSemestre->id,
                'school_year_id' => $cicloActivo->id,
                'registration_date' => now(),
                'active' => true,
            ]);

            DB::commit();

            return back()->with('success', 'El alumno fue avanzado correctamente.');
        } catch (\Exception $e) {
            //return $e;
            DB::rollBack();
            return back()->with('error', 'Error al avanzar al alumno.');
        }
    }
}
