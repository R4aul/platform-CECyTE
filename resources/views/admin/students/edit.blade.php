<x-app-layout>
    <div class="p-7">

        <div class="bg-white rounded shadow-lg p-6">
            <form action="{{route('students.update', $student)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input class="w-full" name="name" value="{{old('name',$student->name)}}"/>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Apellido Paterno
                    </x-label>
                    <x-input class="w-full" name="paternal_surname" value="{{old('paternal_surname',$student->paternal_surname)}}"/>
                    @error('paternal_surname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label>
                        Apellido Materno
                    </x-label>
                    <x-input class="w-full" name="maternal_surname" value="{{old('maternal_surname',$student->maternal_surname)}}"/>
                    @error('maternal_surname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <x-label>
                        Email
                    </x-label>
                    <x-input class="w-full" type="email" name="email" value="{{old('email',$student->email)}}"/>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="flex justify-end">
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>