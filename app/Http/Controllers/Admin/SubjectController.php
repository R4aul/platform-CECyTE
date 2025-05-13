<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
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
