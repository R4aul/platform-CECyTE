<div class="max-w-3xl mx-auto p-6">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Registrar Alumnos</h2>

    @if (session()->has('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        @foreach($alumnos as $index => $alumno)
            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-700">Alumno #{{ $index + 1 }}</h3>

                    @if($index > 0)
                        <button type="button"
                                class="text-red-500 hover:text-red-600 text-sm font-medium"
                                wire:click="removeAlumno({{ $index }})">
                            Eliminar
                        </button>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input type="text" placeholder="Nombre"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.name">
                        @error("alumnos.$index.nombre")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    

                    <div>
                        <input type="text" placeholder="Apellido Paterno"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.paternal_surname">
                        @error("alumnos.$index.apellido")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="text" placeholder="Apellido Materno"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.maternal_surname">
                        @error("alumnos.$index.apellido")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="text" placeholder="Matricula"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.matriculation">
                        @error("alumnos.$index.nombre")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="email" placeholder="Correo"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.email">
                        @error("alumnos.$index.correo")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <input type="password" placeholder="Contraseña"
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               wire:model="alumnos.{{ $index }}.password">
                        @error("alumnos.$index.matricula")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <button type="button"
                    class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 px-5 py-2 rounded-lg text-sm"
                    wire:click="addAlumno">
                + Agregar alumno
            </button>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm shadow">
                Registrar alumnos
            </button>
        </div>
    </form>
</div>
