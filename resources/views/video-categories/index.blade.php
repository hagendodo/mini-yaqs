<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-right">
                    <x-primary-link href="{{ route('video-categories.create') }}">Add Video Category</x-primary-link>
                </div>
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <div class="w-full align-middle">
                        <table class="w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left w-20">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">#</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left w-48">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($videoCategories as $videoCategory)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 text-gray-900">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 text-gray-900">
                                        {{ $videoCategory->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        <x-primary-link href="{{ route('video-categories.edit', $videoCategory->id) }}">Edit</x-primary-link>
                                        <form method="POST" action="{{ route('video-categories.destroy', $videoCategory->id) }}" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @method('DELETE')
                                            @csrf
                                            <x-danger-button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">
                                                Delete
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($videoCategories) == 0)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900" colspan="3">
                                        <p class="text-center">No Data</p>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2 d-flex justify-content-center">
                        {{ $videoCategories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
