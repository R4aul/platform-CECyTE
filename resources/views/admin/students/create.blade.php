<x-app-layout>
    <div class="p-7">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear alumno</h1>
        <div class="bg-white rounded shadow-lg p-6">
            <form action="{{route('students.store')}}" method="post">
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
                        Matricula
                    </x-label>
                    <x-input class="w-full" name="matriculation" />
                    @error('matriculation')
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
    
                <div class="flex justify-end">
                    <x-button>
                        Crear Alumno
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
