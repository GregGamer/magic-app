<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Card;
use App\Models\FetchScryfallApi;
use App\Models\RawCard;
use Illuminate\Http\Request;

class ArchiveCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $archive_slug, $card_oracle_id )
    {
        RawCard::update_CardPrintings_By_OracleId($card_oracle_id);

        $archive = Archive::where('slug', $archive_slug)->first();
        $printings = RawCard::get_CardPrintings_By_OracleId($card_oracle_id);
        $single_card = $printings->first();
        //$card = Card::where('rawcard_id', RawCard::where('oracle_id', $card_oracle_id)->first()->id)->first();
        
        return view('cards.show', [
            'card' => $single_card,
            'archive' => $archive,
            'printings' => $printings
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function search(Request $request){
        if ( $request->fetch == 'database' ){
            //GET Parameters: fetch=database&name={name}
            return RawCard::where('name', $request->name)->orWhere('printed_name', $request->name)->get()->groupBy('oracle_id')->pluck(0); 
        } elseif ( $request->fetch == 'scryfall' ) {
            if ( isset($request->name) ) {
                //GET Parameters: fetch=scryfall&name={name}
                $responses = FetchScryfallApi::fetch_Cards_By_Name($request->name)->groupBy('oracle_id')->pluck(0);
               
                return $responses;
            }
            if ( isset($request->q) ) {
                //GET Parameters: fetch=scryfall&q={query}
                return FetchScryfallApi::fetch_Card_By_Query($request->q)->groupBy('oracle_id')->pluck(0);
            }
        }

        return 'GET parameter were incorrect';
    }
}
