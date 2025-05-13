<x-app-layout>
    <div class="p-7">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div
                class="flex items-center justify-between flex-wrap md:flex-nowrap space-y-4 md:space-y-0 pb-4 bg-white p-4">
                <!-- Botón Crear Estudiante -->
                <a href="{{ route('schoolYears.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Crear Nuevo ciclo escolar
                </a>
            </div>

            <!-- Tabla de estudiantes -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">fecha de inicio</th>
                        <th scope="col" class="px-6 py-3">Fecha de terminacion</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="students-table">
                    @foreach ($schoolYears as $schoolYear)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 student-row">
                            <td class="px-6 py-4">{{ $schoolYear->name }}</td>
                            <td class="px-6 py-4">{{ $schoolYear->start_date }}</td>
                            <td class="px-6 py-4">{{ $schoolYear->final_date }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('schoolYears.edit', $schoolYear) }}"
                                    class="font-medium text-blue-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
