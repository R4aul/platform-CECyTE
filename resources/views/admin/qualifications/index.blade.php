<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Listado de Calificaciones</h1>
        @foreach ($alumnos as $alumno)
            <div class="bg-white shadow-md rounded p-4 mb-6">
                <h2 class="text-xl font-semibold">{{ $alumno->name }} {{ $alumno->paternal_surname }}
                    ({{ $alumno->matriculation }})</h2>

                <div class="mt-2 mb-4 flex flex-wrap gap-2">
                    @foreach ($parciales as $parcial)
                        <a href="{{ route('qualifications.create', [
                            'alumno_id' => $alumno->id,
                            'semestre_id' => $parcial->semester_id,
                            'parcial_id' => $parcial->id,
                        ]) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Asignar Parcial {{ $parcial->number }}
                        </a>
                    @endforeach
                </div>

                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 bg-gray-100 text-left">Materia</th>
                                @foreach ($parciales as $parcial)
                                    <th class="border px-4 py-2 bg-gray-100 text-center">Parcial {{ $parcial->numero }}
                                    </th>
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
                                                fn($c) => $c->subject_id == $materia->id &&
                                                    $c->partial_id == $parcial->id,
                                            );
                                        @endphp
                                        <td class="border px-4 py-2 text-center">
                                            {{ $cal?->grade ?? 'N/A' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
