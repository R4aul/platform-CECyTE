<x-student-layout>
    @push('css')
        <!-- Include stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush
    <div class="bg-gray-50 p-6 min-h-screen">
        <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-md p-8 space-y-6">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Columna izquierda: Información y vista previa -->
                <div class="w-full lg:w-2/3 space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">📘 Materia: {{ $material->subject->subject_name }}
                        </h1>
                        <h2 class="text-xl font-semibold text-gray-700 mt-2">📝 Actividad: {{ $material->material_name }}
                        </h2>
                        <p class="mt-2 text-gray-600">{{ $material->material_description }}</p>
                        <div class="prose">
                            {!! $material->body !!}
                        </div>
                    </div>

                    {{-- Vista previa del archivo --}}
                    <div class="mb-6">
                        @if ($material->fileType === 'pdf')
                            <iframe src="{{ asset($material->path) }}" class="w-full h-[500px] border rounded-md"
                                frameborder="0"></iframe>
                        @else
                            <img src="{{ asset($material->path) }}" alt="Vista previa"
                                class="w-full max-h-[500px] object-contain rounded-md">
                        @endif
                    </div>
                </div>

                <!-- Columna derecha: Formulario -->
                <div class="w-full lg:w-1/3 bg-gray-50 p-6 rounded-xl shadow space-y-4">
                    <form action="{{ route('students.task.store', $material) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700">Subir un archivo (PDF, imágenes, Word,
                            etc):</label>
                        <input type="file" id="archivo" name="file" onchange="agregarArchivo(this)"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">


                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold">Comentarios</label>
                            <div id="editor"></div>
                            <textarea class="hidden" name="body" id="body" cols="30" rows="10"></textarea>
                            @error('body')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón enviar -->
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
                            Enviar actividad
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                document.querySelector('#body').value = quill.root.innerHTML;
            })
        </script>
    @endpush
</x-student-layout>
