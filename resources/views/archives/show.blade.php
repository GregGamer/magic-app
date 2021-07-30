<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Archive: '.$archive->name) }}
            </h2>

            <a href="{{route('cards.create')}}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                Create Archive
            </a>
        </div>
    </x-slot>
    
    @include('archives.search')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('archives.cards')
            </div>
        </div>
    </div>
</x-app-layout>
