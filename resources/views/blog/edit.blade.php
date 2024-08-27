<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="mb-6">
                    <header class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Blog Post') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update the details below to edit the blog post.") }}
                            </p>
                        </div>

                        <a href="{{ route('blog.index') }}" class="inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            All Blogs
                        </a>
                    </header>
                </section>

                <x-alert />

                <section>
                    <form method="POST" action="{{ route('blog.update', $blog->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $blog->title)" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Details -->
                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Details')" />
                            <x-textarea id="details" class="block mt-1 w-full" name="details" rows="5" required>{{ old('details', $blog->details) }}</x-textarea>
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
