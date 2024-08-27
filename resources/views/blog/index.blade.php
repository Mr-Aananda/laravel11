<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section class="mb-6">
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
                </section>

                <x-alert />

                <section>
                    <div class="mt-2 relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full bg-white shadow-md rounded-xl border border-gray-300">
                            <thead>
                                <tr class="bg-blue-gray-100 text-gray-700 border-b border-gray-300">
                                    <th class="py-3 px-4 text-left border-r border-gray-300">#</th>
                                    <th class="py-3 px-4 text-left border-r border-gray-300">Title</th>
                                    <th class="py-3 px-4 text-left border-r border-gray-300">Details</th>
                                    <th class="py-3 px-4 text-left border-r border-gray-300">Created By</th>
                                    <th class="py-3 px-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-blue-gray-900">
                                @forelse ($blogs as $index => $blog)
                                    <tr class="border-b border-gray-300">
                                        <td class="py-3 px-4 border-r border-gray-300">{{ $index + 1 }}.</td>
                                        <td class="py-3 px-4 border-r border-gray-300">{{ $blog->title }}</td>
                                        <td class="py-3 px-4 border-r border-gray-300">{{ Str::limit($blog->details, 50) }}</td>
                                        <td class="py-3 px-4 border-r border-gray-300">{{ $blog->user?->name }}</td>
                                        <td class="py-3 px-4 flex justify-end">
                                            <a href="{{ route('blog.show', $blog->id) }}" class="inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Show
                                            </a>

                                            <a href="{{ route('blog.edit', $blog->id) }}" class="ms-1 inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                Edit
                                            </a>
                                            <!-- Delete Form -->
                                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" class="ms-1 inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 text-gray-700 bg-gray-200 border border-transparent rounded-md text-xs font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" onclick="return confirm('Are you sure you want to delete this blog?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">
                                            No blogs available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
