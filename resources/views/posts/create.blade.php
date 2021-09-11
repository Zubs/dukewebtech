@extends('layouts.blog')

@section('content')
    <h1>Create New Post</h1>
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="flex bg-red-100 rounded-lg p-4 mb-4">
                <svg class="w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <p class="ml-3 text-sm text-red-700">
                    <span class="font-medium">Important Note!</span> {{ $error }}.
                </p>
            </div>
        @endforeach
    @endif
    <div>
        <div class="md:grid md:grid-cols-2 md:gap-6">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('store-post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="base-input" class="text-sm font-medium text-gray-900 block mb-2">Title</label>
                        <input type="text" name="title" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter title here...." required value="{{ old('title') }}">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="text-sm font-medium text-gray-900 block mb-2">Body</label>
                        <textarea id="message" name="body" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter post content...." required>{{ old('body') }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="base-input" class="text-sm font-medium text-gray-900 block mb-2">Audio</label>
                        <input type="file" name="audio" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('title') }}">
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="block text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 mb-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
