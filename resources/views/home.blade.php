@extends('layouts.main')
@section('content')

    <div class="container mx-auto ">
        <div class="mt-10 max-w-xl mx-auto">
        @foreach($posts as $post)
            <div class="border-b mb-5 pb-5 border-gray-200">
                <a href="{{route('posts.show', $post->slug)}}" class="text-2xl font-bold mb-2">{{ $post->title }}</a>
                <p>{{ Str::limit($post->description, 100) }}</p>
                <span class="flex items-center text-sm text-light mt-2">
                    {{ $post->publication_date->diffForHumans() }} | by
                    {{$post->author->name}}
                </span>
            </div>
        @endforeach

        <div class="mb-5">
            {{ $posts->links() }}
        </div>
        </div>
        
    </div>

@endsection

