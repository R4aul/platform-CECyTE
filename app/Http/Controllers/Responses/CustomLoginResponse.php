<?php

namespace App\Http\Controllers\Responses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Responses\LoginResponse as LoginResponseContract;

class CustomLoginResponse extends LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->hasRole('Alumno')) {
            return redirect()->route('panel.alumnos'); // Ruta del panel de alumnos
        } else {
            return redirect()->route('dashboard'); // Ruta para otros roles
        }
    }
}
