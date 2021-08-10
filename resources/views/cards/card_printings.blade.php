<div class="flex flex-col">
    <div class="-overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full h-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Set Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Anz in Archive
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Add</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Remove</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- TODO write a better solution for the api fetches --}}
                    @foreach(App\Models\RawCard::getCardPrintings($card->rawcard->scryfall_id) as $printing)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900">{{$loop->iteration}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ Illuminate\Support\Facades\Http::get($printing->set_uri)->object()->icon_svg_uri }}"
                                             alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$printing->set_name}}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{$printing->collector_number}} {{$printing->set}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900">{{App\Models\Card::where([['archive_id', '=', $archive->id],['scryfall_uuid', '=', $printing->id]])->get()->count()}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Substract One</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Add One More</a>
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
