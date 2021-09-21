<div class="felx flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                @if(!json_decode($card->card_faces))
                    @include('cards.components.card_face', ['card_face' => $card])
                @elseif (json_decode($card->card_faces))
                    @foreach(json_decode($card->card_faces) as $card_face)
                        @include('cards.components.card_face', ['card_face', $card_face])
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</div>
