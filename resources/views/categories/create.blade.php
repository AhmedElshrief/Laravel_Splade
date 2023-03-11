<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('new_cat') }}
            </h2>
            <Link href="{{ route('categories.create') }}"
                class="px-2 py-4 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">Create</Link>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-form :action="route('categories.store')" class="max-w-md mx-auto p-4 bg-white rounded-md">
                <div class="row">
                    @foreach (config('translatable.locales') as $locale)
                        <div class="col-md-6">
                            <div class="form-group">
                                @if (count(config('translatable.locales')) > 1)
                                    <label class="required">@lang('site.' . $locale . '.name')</label>
                                @else
                                    <label class="required">@lang('site.name')</label>
                                @endif
                                <x-splade-input  type="text" name="{{ $locale }}[name]" class="form-control"/>
                               
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- <x-splade-input name="name" label="Name" /> --}}

                <x-splade-input name="slug" label="__('slug')" />

                <x-splade-submit class="mt-4" />
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
