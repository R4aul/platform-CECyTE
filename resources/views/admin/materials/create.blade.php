<x-app-layout>
    <div class="p-7">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Materiales de {{ $subject->subject_name }}</h1>
    
        <!-- Formulario para subir material -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Subir nuevo material</h2>
    
            <form action="{{ route('materials.store', $subject) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Nombre del Material</label>
                    <input type="text" name="name" required
                        class="w-full border-gray-300 p-2 rounded focus:ring focus:ring-blue-200">
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Descripción</label>
                    <textarea name="description" class="w-full border-gray-300 p-2 rounded focus:ring focus:ring-blue-200"></textarea>
                </div>
    
                <div class="mb-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haga clic para cargar</span>
                                    o arrastre y suelte</p>
                                <p class="text-xs text-gray-500">PDF, PNG, JPG</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
    
    
                </div>
    
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
                    Subir Material
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
