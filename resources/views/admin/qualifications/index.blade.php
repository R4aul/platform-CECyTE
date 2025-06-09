<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Listado de Calificaciones</h1>

        <!-- Formulario de búsqueda -->
        <div class="mb-6 bg-gray-50 p-6 rounded-lg shadow-md">
            <form action="{{ route('qualifications.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="flex flex-col">
                    <label for="search" class="text-gray-700 font-medium mb-2">Matrícula</label>
                    <input type="text" name="search" id="search" placeholder="Buscar por matrícula..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex items-end md:col-span-3">
                    <button type="submit"
                        class="w-full md:w-auto bg-blue-500 text-white rounded-lg py-2 px-4 mt-4 md:mt-0 hover:bg-blue-600">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de alumnos -->
        @forelse ($alumnos as $alumno)
            <div x-data="{ open: false }" class="bg-white shadow-md rounded p-4 mb-6 border border-gray-200">
                <!-- Encabezado del acordeón -->
                <button @click="open = !open" class="w-full text-left text-xl font-semibold flex justify-between items-center">
                    {{ $alumno->name }} {{ $alumno->paternal_surname }} ({{ $alumno->matriculation }})
                    <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Contenido del acordeón -->
                <div x-show="open" x-collapse class="mt-4 overflow-hidden">
                    <!-- Botones para asignar calificaciones -->
                    <div class="mb-4 flex flex-wrap gap-2">
                        @foreach ($parciales as $parcial)
                            <a href="{{ route('qualifications.create', [
                                'alumno_id' => $alumno->id,
                                'semestre_id' => $alumno->inscriptionsActive->semester_id,
                                'parcial_id' => $parcial->id,
                            ]) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Asignar Parcial {{ $parcial->number }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Tabla de calificaciones -->
                    <div class="overflow-x-auto mt-2">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2 bg-gray-100 text-left">Materia</th>
                                    @foreach ($parciales as $parcial)
                                        <th class="border px-4 py-2 bg-gray-100 text-center">Parcial {{ $parcial->number }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materias as $materia)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $materia->subject_name }}</td>
                                        @foreach ($parciales as $parcial)
                                            @php
                                                $cal = $alumno->qualifications->firstWhere(
                                                    fn($c) => $c->subject_id == $materia->id && $c->partial_id == $parcial->id
                                                );
                                            @endphp
                                            <td class="border px-4 py-2 text-center">
                                                @if ($cal)
                                                    {{ $cal->grade }}
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded shadow-md">
                No se encontraron alumnos con los criterios ingresados.
            </div>
        @endforelse
    </div>

    <!-- Alpine.js necesario para que funcione el acordeón -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
