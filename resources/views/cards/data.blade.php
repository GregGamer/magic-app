<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div id="card-data">
                    <div id="card-data-row">{{$card->name}}</div>
                    <div id="card-data-row">
                        <div id="card-data-col">
                            <img src="{{json_decode($card->image_uris)->normal}}" alt="Card Printing"/>
                        </div>
                        <div id="card-data-col">
                            <p>{{ $card->printed_text ? $card->printed_text : $card->oracle_text }}</p>
                        </div>
                        <div id="card-data-col">
                            <p>{{ $card->flavor_text }}</p>
                        </div>
                        <div id="card-data-col">
                            <h3 class="text-lg">Rulings</h3>
                            <ol>
                            @foreach ($card->rulings() as $rule)
                               <li>{{ $loop->iteration }}. {{ $rule->comment }}</li> 
                            @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>