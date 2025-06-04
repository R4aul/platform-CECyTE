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
        $studentSemesterId = $student->inscriptionsActive->semester_id;

        // Verificar si tiene al menos una calificación menor a 7 en algún parcial del semestre actual
        $hasLowGrade = Qualification::where('user_id', $student->id)
            ->where('grade', '<', 7)
            ->whereHas('partial', function ($query) use ($studentSemesterId) {
                $query->where('semester_id', $studentSemesterId);
            })
            ->exists();

        $subjectsMaterials = collect(); // Colección vacía por defecto

        if ($hasLowGrade) {
            $subjectsMaterials = Subject::where('semester_id', $studentSemesterId)
                ->whereHas('materials', function ($query) {
                    $query->where('active', true);
                })
                ->with([
                    'materials' => function ($query) {
                        $query->where('active', true);
                    }
                ])
                ->get();
        }

        return view('students.panel-alumnos', compact('subjectsMaterials'));
    }
}
