<x-app-layout>
    <div class="p-7">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Materia {{ $subject->subject_name }}</h1>
        <!-- Formulario para subir material -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-700 mb-4">Actualizar Materia</h2>

            <form action="{{ route('subjects.update', $subject) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4 relative">
                    <figure>
                        <img class="aspect-[16/9] object-cover object-center w-full" src="{{asset('/storage/'.$subject->image)}}"
                            alt="" id="imgPreview">
                    </figure>
                    <div class="absolute top-8 right-8">
                        <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                            Actualizar imagen
                            <input type="file" accept="image/*" name="image_subject" class="hidden"
                                onchange="previewImage(event, '#imgPreview')">
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Nombre de la materia</label>
                    <input type="text" name="name_subject" required
                        class="w-full border-gray-300 p-2 rounded focus:ring focus:ring-blue-200" value="{{$subject->subject_name}}">
                    @error('name_subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
                    Subir Material
                </button>
            </form>
        </div>
    </div>
    @push('js')
        <script>
            function previewImage(event, querySelector){
                //Recuperamos el input que desencadeno la acción
                const input = event.target;
                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);
                // Verificamos si existe una imagen seleccionada
                if(!input.files.length) return
                //Recuperamos el archivo subido
                file = input.files[0];
                //Creamos la url
                objectURL = URL.createObjectURL(file);
                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;
            }
        </script>
    @endpush
</x-app-layout>
