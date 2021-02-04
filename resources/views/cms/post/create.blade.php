<x-app-layout>
    <x-slot name="header">
      <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
            Create a Post
          </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
          <span class="shadow-sm rounded-md">
           <a href="{{ route('posts.index') }}">
              <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out">
              Back
              </button>
           </a>
          </span>
        </div>
      </div>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
        <x-alert-success>{{ session('success') }}</x-alert-success>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        New Post
                    </h3>
                </div>
                <div class="max-w-xl mx-auto px-6 py-6">
                    <form action="{{route('posts.store')}}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm mb-2" for="title">
                                Title
                            </label>
                            <input
                                class="bg-white focus:outline-none focus:shadow-outline border @error('title') border-red-500 @enderror border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal"
                                id="title" name="title" type="text" placeholder="Title of Post" value="{{old('title')}}">
                            @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm mb-2" for="description">
                                Description
                            </label>
                            <textarea
                                class="bg-white focus:outline-none focus:shadow-outline border @error('description') border-red-500 @enderror border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal h-40"
                                id="description" name="description"
                                placeholder="Description">{{old('description')}}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:mt-0 sm:w-auto">
    
                                <button type="submit"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-300 focus:shadow-outline transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    {{-- <a href="#" type="button" > --}}
                                    Publish
                                    {{-- </a> --}}
                                </button>
    
                                {{-- <input type="submit"> --}}
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>    