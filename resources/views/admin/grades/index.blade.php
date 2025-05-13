<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Gestión de Semestres</h2>

        {{-- Mensajes de sesión --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tarjeta del ciclo escolar actual --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="text-lg font-semibold text-gray-700 mb-2">
                Ciclo Escolar Actual: 
                <span class="font-bold text-indigo-600">
                    {{ $cicloActivo ? $cicloActivo->nombre : 'Ninguno activo' }}
                </span>
            </div>
            <form method="POST" action="#">
                @csrf
                <button type="submit"
                        onclick="return confirm('¿Deseas avanzar a TODOS los alumnos al siguiente semestre?')"
                        class="mt-3 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded">
                    Avanzar Todos los Alumnos
                </button>
            </form>
        </div>

        {{-- Tabla de alumnos --}}
        <h4 class="text-xl font-semibold text-gray-800 mb-3">Alumnos Registrados</h4>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Matrícula</th>
                        <th class="px-4 py-3 text-left">Semestre Actual</th>
                        <th class="px-4 py-3 text-left">Acción</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($alumnos as $alumno)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $alumno->name }} {{ $alumno->paternal_surname   }}</td>
                            <td class="px-4 py-3">{{ $alumno->matriculation }}</td>
                            <td class="px-4 py-3">
                                {{ optional($alumno->inscriptionsActive->semester)->semester_name ?? 'Sin registro' }}
                            </td>
                            <td class="px-4 py-3">
                                @if($alumno->inscriptionsActive)
                                    <form action="{{route('semester.advanceStudent',['id'=>$alumno->id])}}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('¿Avanzar este alumno?')"
                                                class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded text-sm">
                                            Avanzar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-red-500 italic">No inscrito</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
