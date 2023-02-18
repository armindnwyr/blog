<x-admin-layout>
    <form action="{{ route('admin.posts.update', $post) }}" method="post">
        @csrf
        @method('put')
        <div class="bg-white rounded p-6 shadow-lg">
            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label>Titulo</x-label>
                <x-input type="text" class="w-full" name="name" id="name" value="{{ old('name', $post->name) }}"
                    onkeyup="string_to_slug()" />
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
            {{-- CKEDITO5  --}}
            <div class="mb-4">
                <x-label>Descripción</x-label>
                <textarea id="editor" name="description">{{ old('description', $post->description) }}</textarea>
            </div>
            {{-- button update   --}}
            <div class="flex justify-end">
                <x-button>
                    Update
                </x-button>
            </div>

        </div>
    </form>
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
    </script>
</x-admin-layout>
