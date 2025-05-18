<x-app-layout>
    <div class="p-7">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear ciclo escolar</h1>
        <div class="bg-white rounded shadow-lg p-6">
            <form action="{{route('schoolYears.store')}}" method="post">
                @csrf
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input class="w-full" name="name" placeholder="Ej. 2025-2026" value="{{old('name')}}"/>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label>
                        Fecha de inicio
                    </x-label>
                    <x-input class="w-full" name="start_date" type="date" value="{{old('start_date')}}" />
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label>
                        Fecha de terminacion
                    </x-label>
                    <x-input class="w-full" name="final_date" type="date" value="{{old('final_date')}}"/>
                    @error('final_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="active" value="{{old('active')}}" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900">Publicar ciclo escolar</span>
                    </label>


                    @error('active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end mt-6">
                    <x-button>
                        Crear ciclo escolar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
