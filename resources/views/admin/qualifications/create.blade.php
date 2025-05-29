<x-app-layout>
    <div class="max-w-xl mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md"> <!-- Tarjeta -->
            <h1 class="text-2xl font-bold mb-4">Asignar Calificaciones</h1>

            <form action="{{ route('qualifications.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ $alumno->id }}">
                <input type="hidden" name="parcial_id" value="{{ $parcial->id }}">

                <p class="text-lg font-semibold">Alumno: {{ $alumno->name }} {{ $alumno->paternal_surname }}</p>
                <p class="text-sm text-gray-600 mb-4">Parcial: {{ $parcial->number }}</p>

                @foreach ($materias as $materia)
                    @php
                        $calificacionExistente = $alumno->qualifications->firstWhere(
                            fn($q) => $q->subject_id === $materia->id && $q->partial_id === $parcial->id,
                        );
                    @endphp
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">{{ $materia->subject_name }}</label>
                        <input type="number" name="calificaciones[{{ $loop->index }}][calificacion]" step="0.1"
                            min="0" max="10"
                            value="{{ old("calificaciones.$loop->index.calificacion", $calificacionExistente?->grade) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-300">
                        <input type="hidden" name="calificaciones[{{ $loop->index }}][materia_id]"
                            value="{{ $materia->id }}">
                    </div>
                @endforeach

                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-150">
                    Guardar Calificaciones
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
