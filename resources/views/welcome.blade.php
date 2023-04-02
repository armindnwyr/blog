<x-app-layout>
    <figure class="mt-12">
        <img src="{{ asset('image/portada.jpg') }}" alt="" srcset="" class="aspect-[3/1] w-full object-cover object-center">
    </figure>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-3xl text-center mt-10 font-semibold dark:text-gray-500 mb-6">
            Ultimas Publicaciones
        </h1>

        <div class="space-y-8">
            @foreach ($post as $posts)
        <article class="grid grid-cols-1 md:grid-cols-2  gap-6">
            <figure>
                <img src="{{ $posts->imageThum() }}" alt="" srcset="" class="object-cover object-center rounded-lg">
            </figure>
            <div>
                <h1 class="text-xl font-semibold">{{ $posts->name }}</h1>
                <hr class="mt-1 mb-2">
                <div class="mb-2">
                    @foreach ($posts->tags as $tag)
                    <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">
                        {{ $tag->name }}
                    </span>
                    @endforeach
                </div>
                <p class="text-gray-500 text-sm mb-2">
                    {{ $posts->update_at->format('d M Y') }} - {{ $posts->user->name }}
                </p>
                <div class="text-justify mb-4">
                    {{ Str::limit($posts->summary, 200) }}
                </div>

                <div>
                    <a href="{{ route('posts.show', $posts) }}" class="mt-4 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Ver más</a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $post->links() }}
    </div>
    </section>
</x-app-layout>