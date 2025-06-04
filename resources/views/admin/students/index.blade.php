<x-app-layout>
    <div class="p-7">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de Alumnos</h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div
                class="flex items-center justify-between flex-wrap md:flex-nowrap space-y-4 md:space-y-0 pb-4 bg-white p-4">
                <!-- Botón Crear Estudiante -->
                <a href="{{ route('students.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Crear Estudiante
                </a>

                <!-- Filtro de búsqueda y semestre -->
                <div class="flex space-x-4 w-full md:w-auto">
                    <!-- Filtro de semestre -->

                    <!-- Campo de búsqueda -->
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="search-input"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar por nombre o correo">
                    </div>
                </div>
            </div>

            <!-- Tabla de estudiantes -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Apellido Paterno</th>
                        <th scope="col" class="px-6 py-3">Apellido Materno</th>
                        <th scope="col" class="px-6 py-3">Matricula</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="students-table">
                    @foreach ($students as $student)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 student-row"
                            data-semester="{{ $student->semester_id }}">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
                                    alt="Jese image">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $student->name }}</div>
                                    <div class="font-normal text-gray-500">{{ $student->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $student->paternal_surname }}</td>
                            <td class="px-6 py-4">{{ $student->maternal_surname }}</td>
                            <td class="px-6 py-4">{{ $student->matriculation }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('students.edit', $student) }}"
                                    class="font-medium text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST"
                                    class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('.delete-form');

                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const confirmed = confirm(
                            '¿Estás seguro de que deseas eliminar este estudiante?');

                        if (!confirmed) {
                            e.preventDefault(); // Cancela el envío del formulario
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
