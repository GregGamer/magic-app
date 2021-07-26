<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'collection_id',
        'isFolder',
        'maxCardsInSlot'
    ];
}
