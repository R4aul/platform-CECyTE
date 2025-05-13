<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function index(Subject $subject)
    {
        $subject->with('materials');
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
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,pdf']
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
            'fileType' => $extension,
            'path' => $path,
            'subject_id' => $subject->id
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
        $subject = $material->subject;

        // Validar datos
        $validated = $request->validate([
            'material_name' => 'required|string|max:255',
            'material_description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048', // imagen o documento
        ]);

        // Si el usuario sube un nuevo archivo
        if ($request->hasFile('file')) {

            // Borrar el archivo anterior si existía
            if ($material->path) {
                $oldPath = str_replace('/storage/', '', $material->path);

                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Subir el nuevo archivo
            $file = $request->file('file');
            $newPath = $file->store('materias/' . $subject->subject_slug . '/imagenes', 'public');

            // Actualizar el path y fileType
            $material->path = '/storage/' . $newPath;
            $material->fileType = $file->getClientMimeType(); // Aquí guardamos el tipo de archivo
        }

        // Actualizar otros campos
        $material->material_name = $validated['material_name'];
        $material->material_description = $validated['material_description'] ?? null;

        $material->save();
        return view('admin.materials.edit', compact('material'));
    }

    public function destroy(Material $material)
    {
        $subject = $material->subject;

        if ($material->path) {
            $path = str_replace('/storage/', '', $material->path); // quitar el '/storage/'

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $material->delete();
        return redirect()->route('materials.index', $subject);
    }
}
