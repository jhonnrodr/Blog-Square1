@extends('layouts.main')
@section('content')

    <div class="container mx-auto ">
        <div class="mt-10 max-w-xl mx-auto">
            <div class="flex justify-end mb-5">
                    <form action="{{ route('home') }}" method="GET">
                        @csrf
                        <select
                        onchange='this.form.submit();'
                        name="orderby" id="orderby" 
                        class="bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 py-2 rounded focus:outline-none focus:shadow-outline">
                            <option value="desc" {{ $order_by === 'desc' ? 'selected' : '' }}>Latest</option>
                            <option value="asc" {{ $order_by === 'asc' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </form>
            </div>

        @foreach($posts as $post)
            <div class="border-b mb-5 pb-5 border-gray-200">
                <a href="{{route('posts.show', $post->slug)}}" class="text-2xl font-bold mb-2">{{ $post->title }}</a>
                <p>{{ Str::limit($post->description, 100) }}</p>
                <div class="flex justify-between text-sm text-light mt-2">
                    <span>{{ $post->publication_date->format('d-m-Y') }} </span>
                    <span>{{ $post->author->name }}</span>
                </div>
            </div>
        @endforeach

        <div class="mb-5">
            {{ $posts->links() }}
        </div>
        </div>
        
    </div>

@endsection

