<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('archives.index', [
            'archives' => Archive::where('collection_id', auth()->user()->currentTeam->id)
                ->with('cards')
                ->get()->sortByDesc('created_at'),
            'public_archives' => Archive::where('public', 1)->with('cards')->get()
                ->sortByDesc('created_at'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('archives.create',[
            'user' => auth()->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:archives', 'max:255'],
            'collection_id' => ['required', 'exists:teams,id']
        ]);

        $archive = new Archive();
        $archive->name = $request->name;
        $archive->slug = Str::slug($request->name);
        $archive->short_description = $request->short_description;
        $archive->description = $request->description;
        $archive->collection_id = $request->collection_id;
        $archive->isFolder = $request->isFolder == 'true';
        $archive->public = $request->public == 'true';
        $archive->maxCardsInSlot = $request->maxCardsInSlot;
        $archive->save();

        return redirect(route('archives.index'))->with('success', 'Archive got created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, Archive $archive)
    {
        if ($request->has('scryfall_id')) {
            return redirect()->route('archives.cards.show', ['archive' => $archive->slug, 'scryfall_id' => $request->scryfall_id]);
        }
        return view('archives.show', [
            'archive' => $archive,
            'cards' => Card::where('archive_id', $archive->id)
                ->with(['archive', 'rawcard'])
                ->get()
                ->groupBy('rawcard_id')

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        return view('archives.edit', ['archive' => $archive, 'user' => auth()->user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'collection_id' => ['required', 'exists:teams,id']
        ]);

        $archive->name = $request->name;
        $archive->slug = Str::slug($request->name);
        $archive->short_description = $request->short_description;
        $archive->description = $request->description;
        $archive->collection_id = $request->collection_id;
        $archive->isFolder = $request->isFolder == 'true';
        $archive->public = $request->public == 'true';
        $archive->maxCardsInSlot = $request->maxCardsInSlot;
        $archive->save();

        return redirect()->route('archives.show', [$archive])->with('success', 'Archive got updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        $archive->delete();

        return redirect()->route('archives.index')->with('success', 'Archive got deleted');
    }
}
