<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Detalle de Tarea</h1>

        <div class="bg-white rounded-xl shadow-md p-6">
            {{-- Cuerpo o descripción de la tarea --}}
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Comentario del usuario {{$task->student->name}}</h2>
                <div class="prose">
                    {!!$task->body!!}
                </div>
            </div>

            {{-- Archivo subido --}}
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Archivo Entregado</h2>

                @if ($task->type_file === 'pdf')
                    <iframe src="{{ asset($task->path_task) }}" class="w-full h-96 border rounded-md" frameborder="0"></iframe>
                @elseif (in_array($task->type_file, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset($task->path_task) }}" alt="Imagen de la tarea" class="w-full h-auto rounded-md">
                @elseif (in_array($task->type_file, ['mp4', 'mov', 'webm']))
                    <video controls class="w-full rounded-md">
                        <source src="{{ asset($task->path_task) }}" type="video/{{ $task->type_file }}">
                        Tu navegador no soporta la reproducción de videos.
                    </video>
                @else
                    <p class="text-red-500">Tipo de archivo no soportado para vista previa.</p>
                @endif
            </div>

            {{-- Botones de acción --}}
            <div class="mt-6 flex space-x-3">
                <a href="{{ asset($task->path_task) }}" download
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Descargar archivo
                </a>
                <a href="{{ route('materials.show', $task->material_id) }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Volver al material
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
