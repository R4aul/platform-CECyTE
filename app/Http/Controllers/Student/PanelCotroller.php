<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Qualification;

class PanelCotroller extends Controller
{
    public function index()
    {
        $student = Auth::user();

    $activeRegistration = $student->inscriptionsActive;

    if (!$activeRegistration) {
        return view('students.panel-alumnos', ['subjectsMaterials' => collect()]);
    }

    $semesterId = $activeRegistration->semester_id;

    // Obtener materias del semestre actual con materiales activos y calificaciones < 7
    $subjectsMaterials = Subject::where('semester_id', $semesterId)
        ->whereHas('materials', fn ($q) => $q->where('active', true))
        ->whereHas('qualifications', function ($query) use ($student) {
            $query->where('user_id', $student->id)
                  ->where('grade', '<', 7);
        })
        ->with([
            'materials' => fn ($q) => $q->where('active', true),
        ])
        ->get();

    return view('students.panel-alumnos', compact('subjectsMaterials'));
    }
}
