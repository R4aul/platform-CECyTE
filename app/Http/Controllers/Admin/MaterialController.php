<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MaterialController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth', // obligatorio para todo el controlador
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.index'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.create'), only: ['create']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.store'), only: ['store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.edit'), only: ['edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.update'), only: ['update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.show'), only: ['show']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('materials.destroy'), only: ['destroy']),
        ];
    }

    public function index(Subject $subject)
    {
        $subject->load([
            'materials' => function ($query) {
                $query->where('user_id', Auth::id());
            },
        ]);
        return view('admin.materials.index', compact('subject'));
    }

    public function create(Subject $subject)
    {
        return view('admin.materials.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'body' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,pdf'],
            'active' => ['boolean'],
        ]);

        $subjectFile = Str::slug($subject->subject_name, '_');
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $typeFile = in_array($extension, ['jpg', 'png', 'jpeg']) ? 'imagenes' : 'documentos';
        // Ruta de almacenamiento en storage/app/public/materias/{materia}/{tipoArchivo}
        $pathFolder = "materias/{$subjectFile}/{$typeFile}";
        $nameFile = uniqid() . '.' . $extension;
        // Guardar el archivo en storage/app/public
        $pathFile = $file->storeAs($pathFolder, $nameFile, 'public');
        $path = Storage::url($pathFile);

        Material::create([
            'material_name' => $request->name,
            'material_description' => $request->description,
            'body' => $request->body,
            'active' => $request->active ?  1 : 0,
            'fileType' => $extension,
            'path' => $path,
            'subject_id' => $subject->id,
            'user_id' => Auth::user()->id
        ]);

        return view('admin.materials.index', compact('subject'));
    }

    public function show(Material $material)
    {
        return view('admin.materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Material $material, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'body' => ['required', 'string'],
            'file' => ['nullable', 'file', 'mimes:png,jpg,jpeg,pdf'],
            'active' => ['boolean'],
        ]);

        $subject = $material->subject;

        $material->material_name = $request->name;
        $material->material_description = $request->description;
        $material->body = $request->body;
        $material->active = $request->active ? 1 : 0;

        if ($request->hasFile('file')) {
            $subjectFile = Str::slug($subject->subject_name, '_');
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $typeFile = in_array($extension, ['jpg', 'png', 'jpeg']) ? 'imagenes' : 'documentos';

            // Eliminar archivo anterior si es necesario
            if ($material->path && Storage::disk('public')->exists(str_replace('/storage/', '', $material->path))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $material->path));
            }

            $pathFolder = "materias/{$subjectFile}/{$typeFile}";
            $nameFile = uniqid() . '.' . $extension;
            $pathFile = $file->storeAs($pathFolder, $nameFile, 'public');
            $material->path = Storage::url($pathFile);
            $material->fileType = $extension;
        }

        $material->save();
        return redirect()->route('dashboard');
    }

    public function destroy(Material $material)
    {
        $subject = $material->subject;

        // Eliminar archivos de las tareas relacionadas
        foreach ($material->tasks as $task) {
            if ($task->path_task) {
                $taskPath = str_replace('/storage/', '', $task->path_task);
                if (Storage::disk('public')->exists($taskPath)) {
                    Storage::disk('public')->delete($taskPath);
                }
            }
            $task->delete(); // eliminar el registro de la tarea
        }

        // Eliminar archivo del material
        if ($material->path) {
            $path = str_replace('/storage/', '', $material->path);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $material->delete(); // eliminar el registro del material

        return redirect()->route('materials.index', $subject);
    }
}
