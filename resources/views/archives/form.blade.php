<div class="" style="margin: 10px">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Archive Information</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Gib hier die Informationen für das Archiv an.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('archives.store')}}" method="POST">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Archive name
                                </label>
                                <input type="text" name="name" id="name" autocomplete="{{old('name')}}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <input type="text" hidden name="collection_id" value="{{$user->currentTeam->id}}">

                            <div class="col-span-6 sm:col-span-3">
                                <label for="short_description" class="block text-sm font-medium text-gray-700">Short
                                    Description</label>
                                <input type="text" name="short_description" id="short_description"
                                       autocomplete="{{old('short_description')}}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description</label>
                                <input type="text" name="description" id="description"
                                       autocomplete="{{old('description')}}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="isFolder" class="block text-sm font-medium text-gray-700">is
                                    Folder? </label>
                                <select id="isFolder" name="isFolder" autocomplete="{{old('isFolder')}}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option selected value="false">No</option>
                                    <option value="true">Yes</option>
                                </select>
                            </div>
                            
                            <div class="col-span-6 sm:col-span-3">
                                <label for="public" class="block text-sm font-medium text-gray-700">
                                    Should this be a public Archive? 
                                </label>
                                <select id="public" name="public" autocomplete="{{old('public')}}"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option selected value="false">No</option>
                                    <option value="true">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
