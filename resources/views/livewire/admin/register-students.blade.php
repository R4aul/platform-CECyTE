<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Registrar Alumnos</h2>

    @if (session()->has('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        @foreach ($alumnos as $index => $alumno)
            <div class="bg-white shadow-md rounded-lg p-6 space-y-4 border">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-xl font-medium text-gray-700">Alumno #{{ $index + 1 }}</h3>
                    @if ($index > 0)
                        <button type="button"
                            class="text-red-500 hover:text-red-600 text-sm font-semibold"
                            wire:click="removeAlumno({{ $index }})">
                            Eliminar
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nombre</label>
                        <input type="text" placeholder="Nombre"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.name">
                        @error("alumnos.$index.name")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Apellido Paterno</label>
                        <input type="text" placeholder="Apellido Paterno"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.paternal_surname">
                        @error("alumnos.$index.paternal_surname")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Apellido Materno</label>
                        <input type="text" placeholder="Apellido Materno"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.maternal_surname">
                        @error("alumnos.$index.maternal_surname")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Matrícula</label>
                        <input type="text" placeholder="Matrícula"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.matriculation">
                        @error("alumnos.$index.matriculation")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Correo</label>
                        <input type="email" placeholder="Correo"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.email">
                        @error("alumnos.$index.email")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Contraseña</label>
                        <input type="password" placeholder="Contraseña"
                            class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-base"
                            wire:model="alumnos.{{ $index }}.password">
                        @error("alumnos.$index.password")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Semestre</label>
                        <select
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-md px-3 py-2"
                            wire:model="alumnos.{{ $index }}.semester_id">
                            <option value="">Selecciona un semestre</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                            @endforeach
                        </select>
                        @error("alumnos.$index.semester_id")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Ciclo escolar</label>
                        <select
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-md px-3 py-2"
                            wire:model="alumnos.{{ $index }}.school_year_id">
                            <option value="">Selecciona el ciclo escolar</option>
                            @foreach ($schoolYears as $schoolYear)
                                <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                            @endforeach
                        </select>
                        @error("alumnos.$index.school_year_id")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 pt-4">
            <button type="button"
                class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm font-medium"
                wire:click="addAlumno">
                + Agregar alumno
            </button>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm shadow font-medium">
                Registrar alumnos
            </button>
        </div>
    </form>
</div>
