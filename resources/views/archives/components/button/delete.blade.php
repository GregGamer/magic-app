<form action="{{route('archives.destroy', [$archive])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="mx-2 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 rounded-md hover:text-white uppercase hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300  transition">
        Delete Archive
    </button>
</form>