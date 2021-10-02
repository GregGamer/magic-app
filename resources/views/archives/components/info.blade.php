<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="flex flex-row p-3 w-full justify-between bg-gray-100">
                    <div class="flex flex-col text-gray-500 text-4xl">
                        {{ $archive->name }}
                        <span class="text-gray-500 text-xl">{{ $archive->short_description }}</span>
                    </div>
                    <div class="flex flex-row">
                        @include('archives.components.button.update')
                        @include('archives.components.button.delete')
                    </div>
                </div>
                <div class="flex flex-row p-5">
                    <div class="w-1/3 p-2">
                        <img src="#" alt="Archive Image">
                    </div>
                    <div class="w-2/3 p-2 flex flex-col h-72 justify-between">
                        <div class="">
                            {{ $archive->description }}
                        </div>
                        <div class="flex flex-row justify-around">
                            <div class="">
                                Cards in Archive: {{ $archive->cards->count() }}
                            </div>
                            <div class="">
                                Publicly available: {{ $archive->public ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>