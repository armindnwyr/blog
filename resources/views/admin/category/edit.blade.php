<x-admin-layout>
    <form class="bg-white rounded p-6 shadow-lg" action="{{ route('admin.categories.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        <x-validation-errors class="mb-4">

        </x-validation-errors>
        <div class="mb-4">
            <x-label>Nombre</x-label>
            <x-input type="text" class="w-full" name="name" id="name" value="{{ old('name', $category->name) }}" />
        </div>

        <div class="flex justify-end">
            <x-danger-button class="mr-2 disabled:opacity-25" type="button" onclick="deletePost()" :disabled="$category->posts->count() != 0">
                Delete
            </x-danger-button>

            <x-button>
                Update
            </x-button>
        </div>
    </form>
    @if ($category->posts->count() == 0)
    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" id="delete">
        @csrf
        @method('delete')

    </form>
    @endif

    @push('js')
    <script>
        function deletePost(){
                form = document.querySelector('form#delete');
                form.submit();
            }
    </script>
    @endpush
</x-admin-layout>
