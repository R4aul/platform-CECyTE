<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Partial;

class QualificationsController extends Controller
{
    
    public function index(){
        $user = Auth::user();
        // Solo se traen las calificaciones del usuario autenticado
        $alumno = $user->load(['qualifications.subject', 'qualifications.partial']);
    
        $materias = Subject::with('semester')->get();
        $parciales = Partial::where('active', true)->get();
    
        return view('students.qualifications.index', [
            'alumno' => $alumno,
            'materias' => $materias,
            'parciales' => $parciales
        ]); 
    }
}
