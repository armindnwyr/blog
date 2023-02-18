<x-admin-layout>
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.posts.create') }}" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">New post</a>
    </div>

    <ul class="space-y-8">

        @foreach ($post as $item)
    
        <li class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
    
            <figure>
                <a href="{{ route('admin.posts.edit', $item) }}">
                    <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $item->imageReplace }}" alt="{{ $item->name }}"> 
                </a>  
            </figure>
    
            <div>
                <h1 class="text-xl font-semibold">{{ $item->name }}</h1>
                <hr class="mt-1 mb-2">

                @if ($item->publish==true)
                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Publicado</span>
                @else
                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded">Sin Publicar</span>
                @endif

                <p class="text-gray-500 mt-2">
                    {{ Str::limit($item->summary, 300)}}
                </p>

                <a href="{{ route('admin.posts.edit', $item) }}" class="mt-4 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Edit</a>
            </div>
    
        </li>
    
        @endforeach
    
    </ul>

    <div class="mt-6">
        {{ $post->links() }}
    </div>

</x-admin-layout>
