<x-admin-layout> 
    <div class="flex justify-end">
        <a href="{{ route('admin.categories.create') }}" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out mb-4"
        >Create</a>

    </div>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-800 dark:text-gray-600">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-000 dark:text-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $cate)
            <tr class="bg-white border-b dark:bg-gray-100 dark:border-gray-100">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">
                    {{ $cate->name }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.categories.edit', $cate->id) }}" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                            Editar
                        </a>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</x-admin-layout> 