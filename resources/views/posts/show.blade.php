<x-app-layout>
    <div class="container max-w-5xl mx-auto">
        <div class="pt-6">
            <a href="#"
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $post->title }}</h5>
                <p class="font-normal text-gray-700">{{ $post->content }}</p>
            </a>
        </div>
    </div>
</x-app-layout>
