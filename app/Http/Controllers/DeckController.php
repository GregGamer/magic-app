<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('decks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('decks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('decks.create')->with('success', 'Deck got STORED');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        return view('decks.show', [
            'deck' => $deck
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function edit(Deck $deck)
    {
        return view('decks.edit', [
            'deck' => $deck
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deck $deck)
    {
        return redirect()->route('decks.index')->with('success', 'Deck got UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();

        return redirect()->route('decks.index')->with('success', 'Deck got DELETED');
    }
}
