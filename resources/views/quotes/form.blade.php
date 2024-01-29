<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __((isset($quote)?'Edit':'Add').' Data') }}
                            </h2>
                        </header>

                        <form method="POST"
                              action="{{ route(isset($quote) ? 'quotes.update' : 'quotes.store', isset($quote) ? $quote->id : null) }}">
                            @if(isset($quote))
                                @method('PUT')
                            @endif
                            @csrf

                            <div>
                                <x-input-label for="category" :value="__('Category')"/>
                                <select id="category" name="quote_category_id" class="block mt-1 mb-4 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required autofocus
                                        autocomplete="quote_category_id">
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ isset($quote) && $quote->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="author" :value="__('Author')"/>
                                <x-text-input id="author" class="block mt-1 w-full mb-4" type="text" name="author"
                                              :value="isset($quote)?$quote->author:old('author')" required autofocus
                                              autocomplete="author"/>
                                <x-input-error :messages="$errors->get('author')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')"/>
                                <textarea id="content" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="content" required autofocus
                                          autocomplete="content"
                                          rows="4">{{ isset($quote) ? $quote->content : old('content') }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                            </div>


                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __(isset($quote)?'Save':'Create') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
