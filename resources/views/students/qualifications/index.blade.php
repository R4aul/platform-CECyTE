<x-student-layout>
    <div class="max-w-7xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Mis Calificaciones</h1>

        <div x-data="{ open: true }" class="bg-white shadow-md rounded p-4 mb-6 border border-gray-200">
            <button @click="open = !open" class="w-full text-left text-xl font-semibold flex justify-between items-center">
                {{ $alumno->name }} {{ $alumno->paternal_surname }} ({{ $alumno->matriculation }})
                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse class="mt-4 overflow-hidden">
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2 bg-gray-100 text-left">Materia</th>
                                @foreach ($parciales as $parcial)
                                    <th class="border px-4 py-2 bg-gray-100 text-center">Parcial {{ $parcial->numero }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                                <tr>
                                    <td class="border px-4 py-2">{{ $materia->subject_name }}</td>
                                    @foreach ($parciales as $parcial)
                                        @php
                                            $cal = $alumno->qualifications->firstWhere(fn($c) =>
                                                $c->subject_id == $materia->id &&
                                                $c->partial_id == $parcial->id
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
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-student-layout>
