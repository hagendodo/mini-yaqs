<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __((isset($video)?'Edit':'Add').' Data') }}
                            </h2>
                        </header>

                        <form method="POST"
                              action="{{ route(isset($video) ? 'videos.update' : 'videos.store', isset($video) ? $video->id : null) }}">
                            @if(isset($video))
                                @method('PUT')
                            @endif
                            @csrf

                            <div>
                                <x-input-label for="category" :value="__('Category')"/>
                                <select id="category" name="video_category_id" class="block mt-1 mb-4 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus
                                        autocomplete="video_category_id">
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ isset($video) && $video->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="title" class="block mt-1 w-full mb-4" type="text" name="title"
                                              :value="isset($video)?$video->title:old('title')" required autofocus
                                              autocomplete="title"/>
                                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                            </div>

                                <div>
                                    <x-input-label for="url" :value="__('Url')"/>
                                    <x-text-input id="url" class="block mt-1 w-full mb-4" type="url" name="url"
                                                  :value="isset($video)?$video->url:old('url')" placeholder="https://www.youtube.com/embed/xxxxxxx" required autofocus
                                                  autocomplete="url"/>
                                    <x-input-error :messages="$errors->get('url')" class="mt-2"/>
                                </div>


                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __(isset($video)?'Save':'Create') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
