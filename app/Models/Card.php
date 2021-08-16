<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['rawcard_id', 'archive_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }

    public function deck(){
        return $this->belongsTo(Deck::class);
    }

    public function rawcard(){
        return $this->belongsTo(RawCard::class);
    }

    public static function store_Card_By_ScryfallId($card_scryfallId, $archive_id){
        $printing = RawCard::where('scryfall_id', $card_scryfallId)->first();

        $card = Card::create([
            'rawcard_id' => $printing->id,
            'archive_id' => $archive_id
        ]);

        return $card;
    }
}
