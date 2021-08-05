<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Archive: '.$archive->name) }}
            </h2>

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

    <script src="/js/search_cards.js"></script>
</x-app-layout>
