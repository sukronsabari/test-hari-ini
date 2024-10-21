<x-app-layout>
    <div class="container max-w-5xl mx-auto">
        <div class="px-4 pt-6">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 text-gray-900">
                <form action="{{ route('posts.store', ['callbackUrl' => request()->query('callbackUrl')]) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @method('POST')
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <x-input.label for="title">Title</x-input.label>
                            <x-input.text id="title" type="text" name="title" class="mt-1" value="{{ old('title') }}"
                                placeholder="E.g: New Arrivals" required />
                            @error('title')
                            <x-input.error :messages="$message" class="mt-2" />
                            @enderror
                        </div>
                        <div class="col-span-6">
                            <x-input.label for="content">Content</x-input.label>
                            <x-input.text id="content" type="text" name="content" class="mt-1" value="{{ old('content') }}"
                                placeholder="E.g: Men's Fashion" required />
                            @error('content')
                            <x-input.error :messages="$message" class="mt-2" />
                            @enderror
                        </div>

                        <div class="col-span-6 flex justify-end">
                            <div class="flex items-center space-x-3">
                                <x-button type="submit">Create</x-button>
                                <x-button.light type="submit" name="create_another">Create & Create Another</x-button.light>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
