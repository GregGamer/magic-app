<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Card extends Model
{
    use HasFactory;

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

    public function scryfall(){
        return $this->belongsTo(RawCard::class, 'scryfall_uuid', 'scryfall_id');
    }

    public function getSetIconUri(){
        $set_uri = RawCard::findOrFail($this->rawcard_id)->set_uri;
        $set = Http::get($set_uri)->object()->data;
        return $set;
    }

}
