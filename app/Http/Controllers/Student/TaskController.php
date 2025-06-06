<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaskController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('students.task.create'), only: ['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('students.task.store'), only: ['store']),
        ];
    }

    public function create(Material $material)
    {
        $userId = Auth::id();

        $existingTask = $material->tasks()
            ->where('user_id', $userId)
            ->first();

        if ($existingTask) {
            return redirect()->back()->with('error', 'Ya has entregado la actividad.');
        }

        return view('students.task.create', compact('material'));
    }

    public function store(Request $request, Material $material)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,pdf']
        ]);

        $subjectFile = Str::slug($material->maaterial_name, '_');
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $typeFile = in_array($extension, ['jpg', 'png', 'jpeg']) ? 'imagenes' : 'documentos';
        // Ruta de almacenamiento en storage/app/public/materias/{materia}/{tipoArchivo}
        $pathFolder = "tasks/{$subjectFile}/{$typeFile}";
        $nameFile = uniqid() . '.' . $extension;
        // Guardar el archivo en storage/app/public
        $pathFile = $file->storeAs($pathFolder, $nameFile, 'public');
        $path = Storage::url($pathFile);


        // Guarda en base de datos (usando un modelo TaskDelivery o similar)
        Task::create([
            'material_id' => $material->id,
            'body' => $request->body,
            'path_task' => $path,
            'type_file' => $extension,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('panel.alumnos');
    }
}
