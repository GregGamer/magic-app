<div class="flex flex-row p-3 w-full">
    <div class="p-3 w-2/3">
        <div class="flex justify-between items-center bg-gray-200 p-3 rounded-lg">
            <div class="text-gray-500 text-4xl">{{ $card_face->name }}</div>
            <div class="flex flex-row justify-between items-center">
                @foreach (App\Models\Symbology::mana_symbols($card_face->mana_cost) as $symbol)
                    <img class="mx-1 drop-shadow-lg w-7" src="{{$symbol->svg_uri}}" alt="{{$symbol->english}}">
                @endforeach
            </div>
        </div>
        <div class="flex justify-between items-center border-2 p-2 mt-5 rounded-lg w-full">
            <p>{{ $card_face->type_line }}</p>
            <p>{{ $card->rarity }} <img class="inline-block h-7" src="{{ $card->edition()->icon_svg_uri}}" alt=""></p>
        </div>
        <div class="flex flex-row items-center py-2">
            @foreach (json_decode($card->keywords) as $keyword)
                <div class="mx-2 text-sm inline-flex items-center font-bold leading-sm px-3 py-1 bg-red-200 text-red-700 rounded-full">
                    {{ $keyword }}
                </div>
            @endforeach
        </div>
        <div class="px-3 flex-grow">
            <div class="py-2">
                <p>{!! App\Models\RawCard::render_text( $card_face->oracle_text, $card_face->name) !!}</p>
            </div>
            @if (isset($card_face->flavor_text))
                <div class="py-2 border-t-2">
                    <span class="italic">{!! preg_replace('/\\n/', '<br>', $card_face->flavor_text) !!}</span>
                </div>
            @endif
        </div>
        <div class="flex flex-row justify-between items-center border-t-2 p-4">
            <div class="flex flex-col">
                <div class="flex flex-row">
                    <div class="mx-2">
                        <a href="{{route('archives.cards.show', ['archive' => $archive, 'scryfall_id' => $card->prevCollNum()->id])}}">
                            <span class="material-icons">
                                chevron_left
                            </span>
                        </a>
                    </div>
                    <div class="mx-2">{{ $card->collector_number }}</div>
                    <div class="mx-2">
                        <a href="{{route('archives.cards.show', ['archive' => $archive, 'scryfall_id' => $card->nextCollNum()->id])}}">
                            <span class="material-icons">
                                chevron_right
                            </span>
                        </a>
                    </div>
                </div>
                <div>
                    <span class="uppercase">{{ $card->edition()->parent_set_code ? $card->edition()->parent_set_code : $card->edition()->code }}</span>
                        +
                    <span class="uppercase">{{ $card->lang }}</span>
                        -
                    {{ $card->artist }}
                </div>
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
            <img class="rounded-2xl" src="{{json_decode($card->image_uris)->normal}}" alt="Card Printing"/>
        </div>
        <div class="flex felx-row justify-between items-center">
            <a href="{{ $card->uri }}" target="_blank">Raw Data</a>
            <a href="{{ $card->scryfall_uri }}" target="_blank">Scryfall</a>
            <a href="{{ json_decode($card->purchase_uris)->cardmarket }}" target="_blank">cardmarket</a>
            <a href="{{ json_decode($card->related_uris)->edhrec }}" target="_blank">EDHREC</a>
        </div>
    </div>
</div>
