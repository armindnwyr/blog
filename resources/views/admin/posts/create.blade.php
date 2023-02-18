<x-admin-layout>
    <form class="bg-white rounded p-6 shadow-lg" action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        <x-validation-errors class="mb-4">
            
        </x-validation-errors>
        <div class="mb-4">
            <x-label>Titulo</x-label>
            <x-input type="text" class="w-full" name="name" value="{{ old('name') }}"/>
        </div>
        <div class="mb-4">
            <x-label>
                Categoria
            </x-label>
            <select name="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                @foreach ($categories as $item)
                <option value="{{ $item->id }}" @selected(old('category_id')==$item->id)>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <x-button>
                Store 
            </x-button>
        </div>
    </form>
</x-admin-layout>
