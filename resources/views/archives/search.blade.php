<div class=" bg-gray-200">
    <div class="container h-20 flex justify-center items-center">
        <div class="relative flex">
            <form action="{{ route('archives.cards.index', ['archive' => $archive->slug]) }}" method="GET">
                <select id="magic-search" name="oracle_id"></select>
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
</div>
