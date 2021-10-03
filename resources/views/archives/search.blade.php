<div class=" bg-gray-200">
    <div class="container h-20 flex justify-center items-center">
        <div class="relative flex">
            <form action="{{ route('archives.show', ['archive' => $archive->slug]) }}" method="GET" class="p-3">
                <select id="magic-search" name="scryfall_id"></select>
                <input type="submit" value="Search all Cards">
            </form>
            <form action="{{ route('archives.cards.show', ['archive' => $archive->slug, 'scryfall_id' => App\Models\FetchScryfallApi::fetch_randomCard()->id]) }}" method="GET" class="p-3">
                <input type="submit" value="Show Random Card">
            </form>
        </div>
    </div>
</div>
