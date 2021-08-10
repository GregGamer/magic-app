<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div id="card-data">
                    <div id="card-data-row">{{$card->rawcard->name}}</div>
                    <div id="card-data-row">
                        <div id="card-data-col">
                            <img href="{{json_decode($card->rawcard->image_uris)->normal}}" alt="Card Printing"/>
                        </div>
                        <div id="card-data-col"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>