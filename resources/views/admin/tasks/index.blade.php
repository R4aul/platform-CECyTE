<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Lista de Tareas Entregadas</h1>

        @if ($material->tasks->isEmpty())
            <p class="text-gray-600">No hay tareas registradas.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($material->tasks as $task)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        {{-- Nombre del material relacionado --}}
                        <h2 class="text-xl font-semibold mb-2">
                            {{ $task->student->name ?? 'Sin material relacionado' }}
                        </h2>

                        {{-- Descripción o cuerpo de la tarea --}}
                        <p class="text-gray-700 mb-3">{{ $task->body }}</p>

                        {{-- Vista previa del archivo --}}
                        <div class="mb-4">
                            @if ($task->type_file === 'pdf')
                                <iframe src="{{ asset($task->path_task) }}" class="w-full h-48 border rounded-md"
                                    frameborder="0"></iframe>
                            @else
                                <img src="{{ asset($task->path_task) }}" alt="Vista previa de la tarea"
                                    class="w-full h-48 object-contain rounded-md">
                            @endif
                        </div>

                        {{-- Botón para descargar --}}
                        <a href="{{ asset($task->path_task) }}" download
                            class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Descargar archivo
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
