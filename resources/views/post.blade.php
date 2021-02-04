@extends('layouts.main')
@section('content')
    <div class="container mx-auto ">
        <div class="max-w-4xl mx-auto py-20 prose lg:prose-xl">
            <h1 class="mb-3 font-bold text-4xl">{{ $post->title }}</h1>   
            <p class="leading-loose">{!! $post->description !!}</p>
        </div>
    </div>
@endsection