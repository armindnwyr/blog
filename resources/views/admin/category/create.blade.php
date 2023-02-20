<x-admin-layout> 
    <form class="bg-white rounded p-6 shadow-lg" action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <x-validation-errors class="mb-4">

        </x-validation-errors>
        <div class="mb-4">
            <x-label>Nombre</x-label>
            <x-input type="text" class="w-full" name="name" id="name" value="{{ old('name') }}"/>
        </div>

        <div class="flex justify-end">
            <x-button>
                Store
            </x-button>
        </div>
    </form>
</x-admin-layout> 