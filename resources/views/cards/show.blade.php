<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @unless ($archive == null)
                    <span class="margin-x-3">Archive: {{$archive->name}}</span>
                @endunless
                {{ __('Card: '. $card->name) }}
            </h2>
        </div>
    </x-slot>
    @include('archives.search')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('cards.data')
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('cards.card_printings')
            </div>
        </div>
    </div>
</x-app-layout>