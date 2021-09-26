<div class=" bg-gray-200">
    <div class="container h-20 flex justify-center items-center">
        <div class="relative flex">
            <form action="{{ route('archives.show', ['archive' => $archive->slug]) }}" method="GET">
                <select id="magic-search" name="scryfall_id"></select>
                <input type="submit" value="Search all Cards">
            </form>
        </div>
    </div>
</div>
