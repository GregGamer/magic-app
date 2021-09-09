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
                        <div class="flex justify-between items-center border-2 p-2 mt-5 rounded-lg w-full">
                            <p>{{ $card->type_line }}</p>
                            <p>{{ $card->rarity }} <img class="inline-block h-7" src="{{ $card->edition()->icon_svg_uri}}" alt=""></p>
                        </div>
                        <div class="p-3">
                            <div class="py-2">
                                <p>{!! $card->render_text() !!}</p>
                            </div>
                            @if ($card->flavor_text)
                                <div class="py-2 border-t-2">
                                    <p class="italic">{{ $card->flavor_text }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-row justify-between items-center border-t-2 p-4">
                            <div class="flex flex-col">
                                <div>{{ $card->collector_number }}/{{ $card->edition()->card_count }}</div>
                                <div>{{ Str::upper($card->edition()->parent_set_code ? $card->edition()->parent_set_code : $card->edition()->code) }} + {{ Str::upper($card->lang) }} - {{ $card->artist }}</div>
                            </div>
                            @if (Str::contains($card->type_line, 'Creature'))
                                <div class="border-2 rounded-lg px-4 py-2">
                                    {{ $card->power }} / {{ $card->toughness }}
                                </div>
                            @elseif (Str::contains($card->type_line, 'Planeswalker'))
                                <div class="border-2 rounded-lg px-4 py-2">
                                    {{ $card->loyalty }} 4
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
