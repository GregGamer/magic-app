<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Describer extends Model
{
    public static function edition()
    {
        return collect([
            'id' => new Field('id', 'scryfall_id', '',
                new ScryfallDataFormat('id', 'UUID', false, 'A unique ID for this set on Scryfall that will not change')),
            'code' => new Field('code', 'code', '',
                new ScryfallDataFormat('code', 'String', false, 'The unique three to five-letter code for this set')),
            'mtgo_code' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'tcgplayer_id' => new Field('id', 'id', 'scryfall_id', '', 'integer'),
            'name' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'set_type' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'released_at' => new Field('id', 'id', 'scryfall_id', '', 'date'),
            'block_code' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'block' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'parent_set_code' => new Field('id', 'id', 'scryfall_id', '', 'string'),
            'card_count' => new Field('id', 'id', 'scryfall_id', '', 'integer'),
            'printing_size' => new Field('id', 'id', 'scryfall_id', '', 'integer'),
            'digital' => new Field('id', 'id', 'scryfall_id', '', 'boolean'),
            'foil_only' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
            'nonfoil_only' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
            'scryfall_uri' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
            'uri' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
            'icon_svg_uri' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
            'search_uri' => new Field('id', 'id', 'scryfall_id', '', 'uuid'),
        ]);
    }
}

class Field
{
    public string $label;
    public string $db_name;
    public string $rules;
    public ScryfallDataFormat $scryfall;

    public function __construct($label, $db_name, $rules, $scryfall)
    {
        $this->label = $label;
        $this->db_name = $db_name;
        $this->rules = $rules;
        $this->scryfall = $scryfall;
    }
}

class ScryfallDataFormat
{
    public string $property;
    public string $type;
    public bool $atn;
    public string $details;

    public function __construct($property, $type, $atn, $details)
    {
        $this->property = $property;
        $this->type = $type;
        $this->atn = $atn;
        $this->details = $details;
    }
}
