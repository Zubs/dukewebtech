@extends('layouts.blog')

@section('content')
    @foreach($posts as $post)
        <a href="{{ route('show-post', ['slug' => $post->slug]) }}" class="flex flex-col md:flex-row rounded-lg bg-white hover:bg-gray-100 border shadow-md items-center mb-6">
            <div class="p-4 flex flex-col justify-between leading-normal">
                <h3 class="text-gray-900 font-bold text-2xl tracking-tight mb-2">{{ $post->title }}</h3>
                <p class="font-normal text-gray-700 mb-3">{{ $post->excerpt }}</p>
                <small>{{ (int) (str_word_count($post->body) / 200) > 0 ? (int) (str_word_count($post->body) / 200) : 1 }} minutes read</small>
            </div>
        </a>
    @endforeach
@endsection
