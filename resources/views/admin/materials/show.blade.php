<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md mt-8">

        {{-- Título --}}
        <h1 class="text-2xl font-bold mb-4">{{ $material->material_name }}</h1>

        {{-- Descripción --}}
        <p class="text-gray-700 mb-6">{{ $material->material_description }}</p>

        <div class="prose">
            {!! $material->body !!}
        </div>

        {{-- Vista previa del archivo --}}
        <div class="mb-6">
            @if ($material->fileType === 'pdf')
                <iframe src="{{ asset($material->path) }}" class="w-full h-[500px] border rounded-md"
                    frameborder="0"></iframe>
            @else
                <img src="{{ asset($material->path) }}" alt="Vista previa"
                    class="w-full max-h-[500px] object-contain rounded-md">
            @endif
        </div>

        <div class="flex flex-wrap gap-4">
            {{-- Botón editar --}}
            <a href="{{ route('materials.edit', $material) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Editar
            </a>

            {{-- Botón eliminar --}}
            <form id="delete-form" method="POST" action="{{ route('materials.destroy', $material) }}">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmDelete()"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Eliminar
                </button>
            </form>

            {{-- Botón ver entregas de alumnos --}}
            <a href="{{ route('admin.tasks.index', $material) }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-flex items-center space-x-2">
                <span>Ver entregas de alumnos</span>
                <span
                    class="bg-white text-green-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">
                    {{ $material->tasks->count() }}
                </span>
            </a>

        </div>
    </div>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "El material se eliminará permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
