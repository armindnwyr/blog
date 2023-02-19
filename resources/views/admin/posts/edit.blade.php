<x-admin-layout>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-6 relative">
            <figure>
                <img id="imgPreview" src="{{ $post->imageReplace }}"
                    class="aspect-[16/9] w-full object-cover object-center rounded-lg">
            </figure>

            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 bg-white rounded-lg">
                    <i class="fa-solid fa-camera mr-3"></i>
                    Actualizar imagen
                    <input type="file" class="hidden" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>

        <div class="bg-white rounded p-6 shadow-lg">
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label>Titulo</x-label>
                <x-input type="text" class="w-full" name="name" id="name"
                    value="{{ old('name', $post->name) }}" onkeyup="string_to_slug()" />
            </div>

            <div class="mb-4">
                <x-label>Slug</x-label>
                <x-input type="text" class="w-full" name="slug" id="slug"
                    value="{{ old('slug', $post->slug) }}" />
            </div>

            <div class="mb-4">
                <x-label>
                    Categoria
                </x-label>
                <select name="category_id"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @selected(old('category_id', $post->category_id) == $item->id)>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <x-label>Resumen</x-label>
                <textarea name="summary" id="" rows="5"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">{{ old('summary', $post->summary) }}</textarea>
            </div>

            <div class="mb-4">
                <x-label>Etiquetas</x-label>
                <select
                    class="js-example-basic-multiple border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    name="tags[]" multiple="multiple">
                    {{-- @foreach ($tags as $item)
                        <option value="{{ $item->id }}" @selected($post->tags->contains($item->id))>{{ $item->name }}</option>
                    @endforeach --}}

                    @foreach ($post->tags as $tag)
                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- CKEDITO5  --}}
            <div class="mb-4">
                <x-label>Descripción</x-label>
                <textarea id="editor" name="description">{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="mb-4">
                <input type="hidden" value="0" name="publish">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="publish" value="1" class="sr-only peer"
                        @checked(old('publish', $post->publish) == 1)>
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-900">¿Quieres publicar?</span>
                </label>
            </div>
            {{-- button update   --}}
            <div class="flex justify-end">
                <x-button>
                    Update
                </x-button>
            </div>

        </div>
    </form>
    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            function string_to_slug() {

                name = document.getElementById("name").value;
                name = name.replace(/^\s+|\s+$/g, '');
                name = name.toLowerCase();
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to = "aaaaeeeeiiiioooouuuunc------";
                for (var i = 0, l = from.length; i < l; i++) {
                    name = name.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }
                name = name.replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');

                document.getElementById('slug').value = name;

            }

            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });

            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    ajax: {
                        url: '{{ route('tags.select2') }}',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term
                            }
                        },

                        processResults: function(data) {
                            return {
                                results: data
                            }
                        }
                    }
                });
            });

            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-admin-layout>
