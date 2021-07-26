<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('cards.index',[
            'cards' => Card::with('archive')
                ->with('edition')
                ->get()
                ->groupBy('name', 'archive_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('cards.create',[
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
            'name' => ['required'],
            'archive_id' => ['required_without:deck_id'],
            'deck_id' => ['required_without:archive_id']
        ]);

        $card = new Card();
        $card->name = $validated->name;
        $card->archive_id = $validated->archive_id;
        $card->deck_id = $validated->deck_id;
        $card->save();

        return redirect()->route('archives.show')->with('success', 'Card got STORED');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('cards.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view('cards.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $card->name = $validated->name;
        $card->save();

        return redirect()->route('archives.show')->with('success', 'Card got UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()->route('archive.show')->with('success', 'Card got DELETED');
    }

    public function fetchCards(Request $request)
    {
        //ddd(Http::get('https://api.scryfall.com/cards/autocomplete',['q' => $request->card_name])->object()->data);

        $respone = Http::get('https://api.scryfall.com/cards/autocomplete', [
            'q'=> $request->card_name
        ])->object()->data;


        if(count($respone) > 1){
            $result = $respone;
        }
        elseif (count($respone) == 1){
            $printings_uri = Http::get('https://api.scryfall.com/cards/named',[
                'exact' => $respone[0]
            ])->object()->prints_search_uri;

            $printings = Http::get($printings_uri)->object()->data;

            $result = $printings;
        }
        elseif (count($respone) < 1){
            $result = $respone;
            //$result = "ERROR, no cards were found";
        }
        return $result;
    }

    public function fetchCards1(Request $request){
        $autocompleteData = Http::get('https://api.scryfall.com/cards/autocomplete', [
            'q'=> $request->card_name
        ])->object()->data;

        ddd(json_encode([
            'identifiers' => json_encode([
                json_encode(['name' => 'Sol Ring']),
                'name' => 'Edgar Markov'
            ])]));

        return Http::post('https://api.scryfall.com/cards/collection ', [
            'identifiers' => json_encode([
                'name' => 'Sol Ring'
            ])
        ]);
    }
}
