<div class="" x-cloak x-data="{ 'archive_showModal_delete': false }">
    <button type="submit" x-on:click="archive_showModal_delete = true" class="mx-2 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 rounded-md hover:text-white uppercase hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300  transition">
        Delete THIS Archive
    </button>
    <div x-show="archive_showModal_delete" class="">
        @include('archives.components.modal.delete')
    </div>
</div>
