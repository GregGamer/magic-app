<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function rawCard(){
        return $this->belongsTo(RawCard::class);
    }

}
