<x-app-layout>
    <div class="p-7">
        <div class="bg-white rounded shadow-lg p-6">
            <form action="{{route('schoolYears.update',$schoolYear)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input class="w-full" name="name" value="{{$schoolYear->name}}"/>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label>
                        Fecha de inicio
                    </x-label>
                    <x-input class="w-full" name="start_date" type="date" value="{{$schoolYear->start_date}}"/>
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <x-label>
                        Fecha de terminacion
                    </x-label>
                    <x-input class="w-full" name="final_date" type="date" value="{{$schoolYear->final_date}}" />
                    @error('final_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                       <input type="checkbox" value="" class="sr-only peer" {{ $schoolYear->active ? 'checked' : '' }}>
 
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900">Publicar ciclo escolar</span>
                    </label>


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

