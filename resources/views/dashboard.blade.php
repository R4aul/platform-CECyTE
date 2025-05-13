<x-app-layout>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Mis Materias</h1>
    
    <!-- Tarjetas de Materias -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($subjects->isEmpty())
            <p class="text-gray-600 text-center">No tienes materias asignadas.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($subjects as $subject)
                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <img src="{{asset($subject->image)}}" alt="{{ $subject->subject_name }}" class="w-full h-40 object-cover rounded">
                        <h2 class="text-xl font-bold text-gray-800 mt-4">{{ $subject->semester_name }}</h2>
                        <p class="text-gray-600">Ciclo Escolar: 2024-2025</p>
                        <a href="{{route('materials.index',$subject)}}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full text-center block">
    Subir Actividad
</a>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
