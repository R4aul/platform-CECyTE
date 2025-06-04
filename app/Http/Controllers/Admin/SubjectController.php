<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubjectController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('subjects.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('subjects.edit'), only: ['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('subjects.update'), only: ['store']),
        ];
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name_subject' => ['required', 'string'],
            'image_subject' => ['nullable', 'image'], // asegúrate de que sea una imagen
        ]);

        // Actualización del nombre
        $subject->subject_name = $request->name_subject;

        // Verificamos si hay imagen
        if ($request->hasFile('image_subject')) {
            // Guardamos la imagen en el disco 'public' dentro de la carpeta 'subject'
            $imagePath = $request->file('image_subject')->store('subject', 'public');

            // Guardamos la ruta en el modelo
            $subject->path_image = $imagePath;
        }

        // Guardamos los cambios
        $subject->save();

        return redirect()->route('subjects.index');
    }
}
