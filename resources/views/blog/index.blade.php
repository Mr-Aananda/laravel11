<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Blog Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Please find all the blog information detailed below.") }}
                            </p>
                        </div>

                        <a href="{{ route('blog.create') }}" class="inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Create new
                        </a>
                    </header>


                    <div class="mt-2 relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full bg-white shadow-md rounded-xl">
                            <thead>
                                <tr class="bg-blue-gray-100 text-gray-700">
                                    <th class="py-3 px-4 text-left">#</th>
                                    <th class="py-3 px-4 text-left">Title</th>
                                    <th class="py-3 px-4 text-left">Details</th>
                                    <th class="py-3 px-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-blue-gray-900">
                                @foreach ($blogs as $index => $blog)
                                    <tr class="border-b border-blue-gray-200">
                                        <td class="py-3 px-4">{{ $index + 1 }}.</td>
                                        <td class="py-3 px-4">{{ $blog->title }}</td>
                                        <td class="py-3 px-4">{{ $blog->details }}</td>
                                        <td class="py-3 px-4 flex justify-end">
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Edit
                                            </a>
                                            <a href="{{ route('blog.show', $blog->id) }}" class="ms-1 inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Show
                                            </a>
                                            <a href="{{ route('blog.destroy', $blog->id) }}" class="ms-1 inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

</x-app-layout>
