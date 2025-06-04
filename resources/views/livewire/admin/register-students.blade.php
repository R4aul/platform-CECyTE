<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Registrar Alumnos</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    <form wire:submit.prevent="addAlumno"
        class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-6 rounded-lg border shadow mb-6">
        <input type="text" placeholder="Nombre" wire:model.live="nuevoAlumno.name" class="input">
        <input type="text" placeholder="Apellido Paterno" wire:model.live="nuevoAlumno.paternal_surname" class="input">
        <input type="text" placeholder="Apellido Materno" wire:model.live="nuevoAlumno.maternal_surname" class="input">
        <input type="text" placeholder="Matrícula" wire:model.live="nuevoAlumno.matriculation" class="input">
        <input type="email" placeholder="Correo" wire:model.live="nuevoAlumno.email" class="input">
        <input type="password" placeholder="Contraseña" wire:model.live="nuevoAlumno.password" class="input">

        <select wire:model.live="nuevoAlumno.semester_id" class="input">
            <option value="">Selecciona un semestre</option>
            @foreach ($semesters as $semester)
                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
            @endforeach
        </select>

        <select wire:model.live="nuevoAlumno.school_year_id" class="input">
            <option value="">Selecciona el ciclo escolar</option>
            @foreach ($schoolYears as $schoolYear)
                <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
            @endforeach
        </select>

        <div class="col-span-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Agregar a la lista
            </button>
        </div>

        {{$errors}}
    </form>

    @if (count($alumnos))
        <div class="bg-white border rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold mb-4">Alumnos por registrar</h3>
            <table class="w-full table-auto border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Nombre completo</th>
                        <th class="px-4 py-2">Matrícula</th>
                        <th class="px-4 py-2">Correo</th>
                        <th class="px-4 py-2">Semestre</th>
                        <th class="px-4 py-2">Ciclo</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $index => $alumno)
                        <tr>
                            <td class="px-4 py-2">{{ $alumno['name'] }} {{ $alumno['paternal_surname'] }}
                                {{ $alumno['maternal_surname'] }}</td>
                            <td class="px-4 py-2">{{ $alumno['matriculation'] }}</td>
                            <td class="px-4 py-2">{{ $alumno['email'] }}</td>
                            <td class="px-4 py-2">
                                {{ $semesters->firstWhere('id', $alumno['semester_id'])?->semester_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $schoolYears->firstWhere('id', $alumno['school_year_id'])?->name }}
                            </td>
                            <td class="px-4 py-2">
                                <button wire:click="removeAlumno({{ $index }})"
                                    class="text-red-600 hover:underline text-xs">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <button wire:click="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">
                    Registrar alumnos
                </button>
            </div>
        </div>
    @endif
</div>
