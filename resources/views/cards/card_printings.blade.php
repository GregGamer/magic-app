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
                            class="px-6 py-3 text-xs font-medium text-gray-500 text-left uppercase tracking-wider">
                            Card Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 text-left uppercase tracking-wider">
                            Set Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 text-left uppercase tracking-wider">
                            Add / Removee
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price on Scryfall
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($printings as $printing)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900">{{$loop->iteration}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('archives.cards.show', ['archive' => $archive, 'scryfall_id' => $printing->scryfall_id])}}" class="text-sm text-gray-900">{{ $printing->printed_name ? $printing->printed_name : $printing->name }}</a>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $printing->lang }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10"
                                             src="{{ $printing->edition()->icon_svg_uri }}"
                                             alt="{{ $printing->set_name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $printing->set_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $printing->collector_number }} {{ $printing->set }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @livewire('card-printing-counter', [ 'archive' => $archive, 'printing' => $printing ] )
                            <td>
                                @if ($price = json_decode($printing->prices)->eur)
                                    <div class="text-sm text-center font-medium text-gray-900">
                                        {{ $price }} ???
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
