<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="flex flex-row p-3">
                    <div class="p-3">
                        <div class="flex justify-between items-center bg-gray-200 p-3">
                            <div class="text-gray-500 text-4xl">{{ $card->name }}</div>
                            <div class="flex flex-row px-3 text-xl w-max h-6">
                                @foreach ($card->mana_symbols() as $symbol)
                                    <img class="px-1 drop-shadow-lg" src="{{$symbol->svg_uri}}" alt="{{$symbol->english}}">
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <p>{{ $card->printed_text ? $card->printed_text : $card->oracle_text }}</p>
                        </div>
                        <div>
                            <p>{{ $card->flavor_text }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg">Rulings</h3>
                            <ol>
                            @foreach ($card->rulings() as $rule)
                               <li>{{ $loop->iteration }}. {{ $rule->comment }}</li>
                            @endforeach
                            </ol>
                        </div>
                    </div>
                    <div class="p-3">
                        <div>
                            <img src="{{json_decode($card->image_uris)->normal}}" alt="Card Printing"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
