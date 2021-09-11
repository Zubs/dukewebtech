@extends('layouts.blog')

@section('content')
    <a href="#" class="block p-6 bg-white hover:bg-gray-100 shadow-md border border-gray-200 rounded-lg mb-6">
        <h3 class="text-gray-900 font-bold text-2xl tracking-tight">{{ $post->title }}</h3>
        <small style="float: right">{{ $post->created_at->diffForHumans() }}</small>
        <small>Author name</small>
        <p class="font-normal text-gray-700 mt-5">{{ $post->body }}</p>
    </a>
@endsection
