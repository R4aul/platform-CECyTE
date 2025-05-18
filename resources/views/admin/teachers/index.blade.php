<x-app-layout>
    <div class="p-7">

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de docentes</h1>    
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex items-center justify-between flex-wrap md:flex-nowrap space-y-4 md:space-y-0 pb-4 bg-white p-4">
                <!-- Botón Crear Estudiante -->
                <a href="{{ route('teachers.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Crear Docente
                </a>
            </div>
    
            <!-- Tabla de estudiantes -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Apellido Paterno</th>
                        <th scope="col" class="px-6 py-3">Apellido Materno</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="students-table">
                    @foreach ($teachers as $teacher)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 student-row">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
                                    alt="Jese image">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $teacher->name }}</div>
                                    <div class="font-normal text-gray-500">{{ $teacher->email }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $teacher->paternal_surname }}</td>
                            <td class="px-6 py-4">{{ $teacher->maternal_surname }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teachers.edit', $teacher) }}"
                                    class="font-medium text-blue-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
