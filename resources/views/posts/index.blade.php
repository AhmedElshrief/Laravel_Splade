<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('posts') }}
            </h2>
            <Link href="{{ route('posts.create') }}" 
            class="px-2 py-4 bg-indigo-400 hover:bg-indigo-600  rounded-md">
                {{__('Create')}}
            </Link>
        </div>
    </x-slot>

    <div class="py-12" style="font-weight: bold">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$posts">
                @cell('action' $post)
                    <Link href="{{ route('posts.edit', $post->id) }}"
                        class="px-2 py-4 bg-indigo-400 hover:bg-indigo-600  rounded-md">
                        {{ __('Edit') }}
                    </Link>
                    <Link confirm="{{ __('confirm_d') }}" confirm-text="{{ __('confirm_del') }}" confirm-button="{{ __('yes') }}" cancel-button="{{ __('no') }}!"
                        href="{{ route('posts.destroy', $post->id) }}" class="text-red-600 hover:text-red-300 font-semibold"
                        method="DELETE" preserve-scroll>
                        {{ __('Delete') }}
                    </Link>
                @endcell
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
