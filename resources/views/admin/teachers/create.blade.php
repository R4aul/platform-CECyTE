<x-app-layout>
    <div class="p-7">
        <div class="bg-white rounded shadow-lg p-6">
            <form action="{{ route('teachers.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input class="w-full" name="name" />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label>
                        Apellido Paterno
                    </x-label>
                    <x-input class="w-full" name="paternal_surname" />
                    @error('paternal_surname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label>
                        Apellido Materno
                    </x-label>
                    <x-input class="w-full" name="maternal_surname" />
                    @error('maternal_surname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label>
                        Email
                    </x-label>
                    <x-input class="w-full" type="email" name="email" />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-label>
                        Contraseña
                    </x-label>
                    <x-input class="w-full" type="password" name="password" />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($semesters as $semester)
                        <div class="border p-4 rounded-lg">
                            <h3 class="text-lg font-semibold">{{ $semester->semester_name }} ({{ $semester->period }})</h3>
                            @foreach ($semester->subjects as $subject)
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    <label class="ms-2 text-sm font-medium text-gray-900">{{ $subject->subject_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end mt-6">
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
