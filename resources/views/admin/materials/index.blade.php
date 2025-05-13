<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Encabezado y Botón -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Materiales Disponibles</h2>
            <a href="{{ route('materials.create', $subject) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Material
            </a>
        </div>

        @if ($subject->materials->isEmpty())
            <p class="text-gray-600 text-center">No hay materiales subidos.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


            @foreach ($subject->materials as $material)
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col">
                    @if (Str::endsWith($material->path, ['.jpg', '.jpeg', '.png']))
                        <img src="{{ asset($material->path) }}" alt="{{ $material->material_name }}"
                            class="w-full h-40 object-cover rounded">
                    @else
                        <div class="bg-gray-200 text-gray-700 text-center py-10 rounded">
                            📄 Archivo PDF
                        </div>
                    @endif

                    <h3 class="text-lg font-bold text-gray-800 mt-3">{{ $material->material_name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $material->material_description }}</p>

                    <a href="{{route('materials.show', $material)}}"
                        class="mt-3 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-center">
                        Ver Archivo
                    </a>
                </div>
            @endforeach
        </div>
        @endif

    </div>
</x-app-layout>
