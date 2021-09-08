<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="flex flex-row p-3 w-full">
                    <div class="p-3 w-2/3">
                        <div class="flex justify-between items-center bg-gray-200 p-3 rounded-lg">
                            <div class="text-gray-500 text-4xl">{{ $card->printed_name ? $card->printed_name : $card->name }}</div>
                            <div class="flex flex-row px-3 text-xl w-max h-6">
                                @foreach ($card->mana_symbols() as $symbol)
                                    <img class="px-1 drop-shadow-lg" src="{{$symbol->svg_uri}}" alt="{{$symbol->english}}">
                                @endforeach
                            </div>
                        </div>
                        <div class="flex justify-between items-center border-2 p-2 my-5 rounded-lg w-full">
                            <p>{{ $card->type_line }}</p>
                        </div>
                        <div class="p-3">
                            <div class="py-2">
                                <p>{!! $card->render_text() !!}</p>
                            </div>
                            <div class="py-2">
                                <p class="italic">{{ $card->flavor_text }}</p>
                            </div>
                            {{-- das '&& false' ist um den Block 'auszuschalten' --}}
                            @if ($card->rulings()->count() != 0 && false)
                                <div class="py-2">
                                    <div class="">Rulings</div>
                                    <ol class="list-decimal list-outside">
                                        @foreach ($card->rulings() as $rule)
                                            <li>{{ $rule->comment }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            @endif
                       </div>
                    </div>
                    <div class="p-3 w-1/3">
                        <div>
                            <img class="rounded-lg" src="{{json_decode($card->image_uris)->normal}}" alt="Card Printing"/>
                        </div>
                        <div class="flex felx-row justify-between items-center">
                            <a href="{{ $card->uri }}" target="_blank">Raw Data</a>
                            <a href="{{ $card->scryfall_uri }}" target="_blank">Scryfall</a>
                            <a href="{{ json_decode($card->purchase_uris)->cardmarket }}" target="_blank">cardmarket</a>
                            <a href="{{ json_decode($card->related_uris)->edhrec }}" target="_blank">EDHREC</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
