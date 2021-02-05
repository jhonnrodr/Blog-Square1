<x-app-layout>
    <x-slot name="header">
      <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
          <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
            Manage Posts
          </h2>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
          <span class="shadow-sm rounded-md">
           <a href="{{ route('posts.create') }}">
              <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out">
                Create Post
              </button>
           </a>
          </span>
        </div>
      </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" bg-white border-b border-gray-200">
                   <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Title
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Publication Date
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($posts as $post)
                          <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              {{ $post->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              {{ Str::limit($post->description, 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              {{ $post->publication_date }}
                            </td>
                          </tr>       
                          @endforeach
                        </tbody>
                      </table>
                      <div class="px-5 py-3">
                        {{ $posts->links() }}
                      </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
