<x-student-layout>
    <div class="bg-gray-50 p-6 min-h-screen">
        <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-md p-8 space-y-6">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Columna izquierda: Información y vista previa -->
                <div class="w-full lg:w-2/3 space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">📘 Materia: {{ $material->subject->subject_name }}</h1>
                        <h2 class="text-xl font-semibold text-gray-700 mt-2">📝 Actividad: {{ $material->material_name }}</h2>
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
                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700">Subir un archivo (PDF, imágenes, Word, etc):</label>
                        <input type="file" id="archivo" name="archivo" onchange="agregarArchivo(this)"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <!-- Lista de archivos cargados -->
                        <ul id="lista-archivos" class="mt-4 space-y-1"></ul>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold">Comentario personal</label>
                            <div id="editor" class="bg-white"></div>
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
        <script>
            const lista = document.getElementById('lista-archivos');
            let archivosCargados = [];

            function agregarArchivo(input) {
                const file = input.files[0];
                if (!file) return;

                archivosCargados.push(file);

                const li = document.createElement('li');
                li.className = 'text-gray-700 bg-green-100 px-4 py-2 rounded-md mb-2 flex justify-between items-center';
                li.innerHTML = `
                <span>📎 ${file.name}</span>
                <span class="text-green-600 font-medium">✔ Subido</span>
            `;
                lista.appendChild(li);

                input.value = '';
            }

            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function () {
                document.querySelector('#body').value = quill.root.innerHTML;
            })
        </script>
    @endpush
</x-student-layout>
