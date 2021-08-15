<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('editions.index',[
            'editions' => Edition::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('editions.index')->with('success', 'Editions got STORED');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function show(Edition $edition)
    {
        return view('editions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function edit(Edition $edition)
    {
        return view('editions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Edition $edition)
    {
        return redirect()->route('editions.index')->with('success', 'Edition got UPDATED');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Edition  $edition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Edition $edition)
    {
        return redirect()->route('editions.index')->with('success', 'Edition got DELETED');
    }


    public static function fetchSets(){
        $editions = Http::get('https://api.scryfall.com/sets')->object()->data;

        foreach ($editions as $edition) {
            $set = new Edition();
            $set->scryfall_id = $edition->id;
            $set->code = $edition->code;
            $set->name = $edition->name;
            $set->scryfall_uri = $edition->scryfall_uri;
            $set->released_at = $edition->released_at;
            $set->set_type = $edition->set_type;
            $set->card_count = $edition->card_count;
            $set->parent_set_code = isset($edition->parent_set_code) ? $edition->parent_set_code : '';
            $set->icon_svg_uri = $edition->icon_svg_uri;
            $set->save();
        }

        return Edition::all();
    }

    public static function updateSets(){
        $countLocal = Edition::all()->count();
        $onlineData = Http::get('https://api.scryfall.com/sets')->object()->data;
        $countOnline = count($onlineData);

        if($countLocal == $countOnline){
            ddd('Die Datenbank ist up to date');
        }
        else{

        }
        ddd($countOnline == $countLocal);
        return $countLocal == $countOnline;
    }
}
