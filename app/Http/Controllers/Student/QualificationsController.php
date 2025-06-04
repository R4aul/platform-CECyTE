<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Partial;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class QualificationsController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('students.qualifications.index'), only: ['index']),
        ];
    }

    public function index()
    {
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
