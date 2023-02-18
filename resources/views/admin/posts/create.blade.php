<x-admin-layout>
    <form class="bg-white rounded p-6 shadow-lg" action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <x-validation-errors class="mb-4">

        </x-validation-errors>
        <div class="mb-4">
            <x-label>Titulo</x-label>
            <x-input type="text" class="w-full" name="name" id="name" value="{{ old('name') }}" onkeyup="string_to_slug()"/>
        </div>

        <div class="mb-4">
            <x-label>Slug</x-label>
            <x-input type="text" class="w-full" name="slug" id="slug" value="{{ old('slug') }}" />
        </div>

        <div class="mb-4">
            <x-label>
                Categoria
            </x-label>
            <select name="category_id"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" @selected(old('category_id') == $item->id)>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <x-button>
                Store
            </x-button>
        </div>
    </form>
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
    </script>
</x-admin-layout>
