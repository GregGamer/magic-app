<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

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
            'archives' => Archive::all()
                ->where('collection_id', auth()->user()->currentTeam->id)
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
        $validated = $request->validate([
            'name' => ['required', 'unique:archives', 'max:255'],
            'collection_id' => ['required', 'exists:teams,id']
        ]);

        $archive = new Archive();
        $archive->name = $validated->name;
        $archive->collection_id = $validated->collection_id;
        $archive->short_description = $validated->short_description;
        $archive->description = $validated->description;
        $archive->isFolder = $validated->isFolder == true;
        $archive->maxCardsInSlot = $validated->maxCardsInSlot;
        $archive->save();

        return redirect(route('archives.index'))->with('success', 'Archive wurde erstellt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, Archive $archive)
    {
        if ($request->has('oracle_id')) {
            return redirect()->route('archives.cards.show', ['archive' => $archive->slug, 'card' => $request->oracle_id]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archive $archive)
    {
        //
    }
}
