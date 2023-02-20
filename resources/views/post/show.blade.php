<x-app-layout>
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-2">
            @foreach ($post->tags as $tag)
            <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">
                {{ $tag->name }}
            </span>
            @endforeach
        </div>
        <div>
            <h1 class="text-4xl font-semibold text-gray-700">{{ $post->name }}</h1>
        </div>
        <hr class="mt-1 mb-2">
        <p class="text-gray-500">
            {{ $post->update_at->format('d M Y') }} - {{ $post->user->name }}
        </p>
        <figure class="mb-6">
            <img src="{{ $post->imageReplace }}" alt="" class="w-full aspect-[16/9] object-cover object-center">
        </figure>
        <div class="text-gray-800">
            {!! $post->description !!}
        </div>
    </section>
</x-app-layout>