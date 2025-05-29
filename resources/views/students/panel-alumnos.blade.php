<x-student-layout>
    
    <div class="min-h-screen bg-gray-100 p-8">
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-4xl mx-auto grid gap-6 grid-cols-1 md:grid-cols-2">
            @forelse ($subjectsMaterials as $index => $subject)
                <!-- Tarjeta de Materia -->
                <div>
                    <button onclick="openModal({{ $index }})"
                        class="w-full bg-white rounded-2xl shadow-md border p-6 flex flex-col items-start hover:shadow-lg transition">

                        <!-- Imagen de la materia -->
                        @php
                            // Buscar la primera imagen disponible
                            $firstImage = $subject->materials->firstWhere('fileType', 'like', 'image%');
                        @endphp

                        @if ($firstImage)
                            <img src="{{ asset($firstImage->path) }}" alt="Imagen de {{ $subject->subject_name }}"
                                class="w-full h-40 object-cover rounded-xl mb-4">
                        @else
                            <div
                                class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-xl mb-4 text-gray-400">
                                Sin imagen
                            </div>
                        @endif

                        <span class="text-2xl font-bold text-gray-800 mb-2">📘 {{ $subject->subject_name }}</span>
                        <span class="text-gray-500 text-sm">Toca para ver actividades</span>
                    </button>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $index }}"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                    <div class="bg-white rounded-2xl p-8 max-w-md w-full relative">
                        <button onclick="closeModal({{ $index }})"
                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                            ✖
                        </button>
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ $subject->subject_name }}</h2>

                        <div class="space-y-4 max-h-80 overflow-y-auto">
                            @forelse ($subject->materials as $material)
                                <div class="p-4 border rounded-lg bg-gray-50">
                                    <h4 class="text-lg font-semibold text-gray-700">{{ $material->material_name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $material->material_description }}</p>
                                    <a href="{{ route('students.task.create', $material) }}"
                                        class="mt-2 inline-block text-sm font-medium text-blue-600 hover:underline">
                                        Ver actividad
                                    </a>
                                </div>
                            @empty
                                <p class="text-gray-500">Sin actividades</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-2">Sin materias disponibles</p>
            @endforelse

        </div>
    </div>

    <!-- Scripts para manejar el modal -->
    <script>
        function openModal(index) {
            document.getElementById(`modal-${index}`).classList.remove('hidden');
            document.getElementById(`modal-${index}`).classList.add('flex');
        }

        function closeModal(index) {
            document.getElementById(`modal-${index}`).classList.add('hidden');
            document.getElementById(`modal-${index}`).classList.remove('flex');
        }
    </script>
</x-student-layout>
