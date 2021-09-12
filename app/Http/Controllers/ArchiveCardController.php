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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $archive_slug, $card_oracle_id )
    {
        RawCard::update_CardPrintings_By_OracleId($card_oracle_id);

        $archive = Archive::where('slug', $archive_slug)->first();
        $printings = RawCard::get_CardPrintings_By_OracleId($card_oracle_id)->sortByDesc('released_at');
        $single_card = $printings->first();
        //$card = Card::where('rawcard_id', RawCard::where('oracle_id', $card_oracle_id)->first()->id)->first();

        return view('cards.show', [
            'card' => $single_card,
            'archive' => $archive,
            'printings' => $printings
        ]);
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
