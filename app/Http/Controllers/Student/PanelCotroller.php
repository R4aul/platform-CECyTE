<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelCotroller extends Controller
{
    public function index()
    {
        $studentSemesterId = Auth::user()->inscriptionsActive->semester_id;

        $subjectsMaterials = Subject::where('semester_id', $studentSemesterId)
            ->whereHas('materials')
            ->with('materials')
            ->get();

        return view('students.panel-alumnos', compact('subjectsMaterials'));
    }
}
