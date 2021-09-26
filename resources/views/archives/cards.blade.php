<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full h-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Number of Cards
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Show
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cards as $card)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{json_decode($card->first()->rawcard->image_uris)->art_crop}}"
                                             alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$card->first()->rawcard->name}}
                                        </div>
                                        <div class="flex flex-row text-xl w-max h-4">
                                            @foreach ($card->first()->rawcard->mana_symbols() as $symbol)
                                                <img class="px-0.5 drop-shadow-lg" src="{{$symbol->svg_uri}}" alt="{{$symbol->english}}">
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900">{{count($card)}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{route('archives.cards.show', ['archive' => $archive->slug, 'scryfall_id'=>$card->first()->rawcard->scryfall_id])}}" class="text-indigo-600 hover:text-indigo-900">Show</a>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More people... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
