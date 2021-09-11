<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex space-x-96">
                <div>{{ __('Dashboard') }}</div>
                <div></div>

                @if(!auth()->user()->is_admin)
                <a href="{{ route('create-post') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                   Add New Post
                </a>
                @endif
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
            <div class="flex bg-green-100 rounded-lg p-4 mb-4">
                <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <p class="ml-3 text-sm text-green-700">
                    <span class="font-medium">{{ session('success') }}</span>
                </p>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Views
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            @if(auth()->user()->is_admin)
                                                <span class="sr-only">Approve</span>
                                            @else
                                                <span class="sr-only">Edit</span>
                                            @endif
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($posts as $post)
                                    <tr>
                                        <td class="py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="{{ route('show-post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $post->excerpt }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $post->views }}
                                            </span>
                                        </td>
                                        <td class="py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $post->published == true ? 'published' : 'draft' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">{{ $post->created_at->diffForHumans() }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if(auth()->user()->is_admin)
                                                <a href="{{ route('edit-post-admin', ['slug' => $post->slug]) }}" class="text-indigo-600 hover:text-indigo-900">Review</a>
                                            @else
                                                <a href="{{ route('edit-post', ['slug' => $post->slug]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
