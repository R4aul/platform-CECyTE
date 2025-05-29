<x-app-layout>
    <div class="p-7">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Listado de Materias</h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    
            <!-- Tabla de estudiantes -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Semestre</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody id="students-table">
                    @foreach ($subjects as $subject)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 student-row">
                            <td class="px-6 py-4">{{ $subject->subject_name }}</td>
                            <td class="px-6 py-4">{{$subject->semester->semester_name}}</td>
                            <td class="px-6 py-4">
                                <a href="{{route('subjects.edit', $subject)}}" class="font-medium text-blue-600 hover:underline">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
