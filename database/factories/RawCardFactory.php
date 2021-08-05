<?php

namespace Database\Factories;

use App\Models\RawCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class RawCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RawCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$randomCard = RawCard::fetchCardByUUID('726e7dc5-2089-4758-93e1-79212aedf75f');
        $randomCard = RawCard::fetchRandomCard();
        //dd(isset($randomCard->all_parts) ? 'zeug' : 'kein zeug');
        print_r($randomCard);

        return [
            //Core Card Fields
            'scryfall_id' => $randomCard->id,
            'lang' => $randomCard->lang,
            'oracle_id' => $randomCard->oracle_id,
            'prints_search_uri' => $randomCard->prints_search_uri,
            'rulings_uri' => $randomCard->rulings_uri,
            'scryfall_uri' => $randomCard->scryfall_uri,
            'uri' => $randomCard->uri,

            //Gameplay Fields
            'all_parts' => isset($randomCard->all_parts) ? json_encode($randomCard->all_parts) : json_encode(''),
            'card_faces' => isset($randomCard->card_faces) ? json_encode($randomCard->card_faces) : json_encode(''),
            'cmc' => $randomCard->cmc,
            'color_identity' => json_encode($randomCard->color_identity),
            'color_indicator' => isset($randomCard->color_indicator) ? json_encode($randomCard->color_indicator) : json_encode(''),
            'colors' => isset($randomCard->colors) ? json_encode($randomCard->colors) : json_encode(''),
            'edhrec_rank' => isset($randomCard->edhrec_rank) ? $randomCard->edhrec_rank : 0,
            'foil' => $randomCard->foil == 'true',
            'hand_modifier' => isset($randomCard->hand_modifier) ? $randomCard->hand_modifier : '',
            'keywords' => json_encode($randomCard->keywords),
            'layout' => $randomCard->layout,
            'legalities' => json_encode($randomCard->legalities),
            'life_modifier' => isset($randomCard->life_modifier) ? $randomCard->life_modifier : '',
            'loyalty' => isset($randomCard->loyality) ? $randomCard->loyality : '',
            'mana_cost' => isset($randomCard->mana_cost) ? $randomCard->mana_cost : '',
            'name' => $randomCard->name,
            'nonfoil' => $randomCard->nonfoil == 'true',
            'oracle_text' => isset($randomCard->oracle_text) ? $randomCard->oracle_text : '',
            'oversized' => $randomCard->oversized == 'true',
            'power' => isset($randomCard->power) ? $randomCard->power : '',
            'produced_mana' => isset($randomCard->produced_mana) ? json_encode($randomCard->produced_mana) : json_encode(''),
            'reserved' => $randomCard->reserved == 'true',
            'toughness' => isset($randomCard->toughness) ? $randomCard->toughness : '',
            'type_line' => $randomCard->type_line,

            //Print Fields
            'artist' => isset($randomCard->artist) ? $randomCard->artist : '',
            'booster' => $randomCard->booster == 'true',
            'border_color' => $randomCard->border_color,
            'card_back_id' => $randomCard->card_back_id,
            'collector_number' => $randomCard->collector_number,
            //'content_warning' => $randomCard->content_warning,
            'digital' => $randomCard->digital == 'true',
            'flavor_name' => isset($randomCard->flavor_name) ? $randomCard->flavor_name : '',
            'flavor_text' => isset($randomCard->flavor_text) ? $randomCard->flavor_text : '',
            'frame_effects' => isset($randomCard->frame_effects) ? json_encode($randomCard->frame_effects) : json_encode(''),
            'frame' => $randomCard->frame,
            'full_art' => isset($randomCard->full_art) ? $randomCard->full_art == 'true' : false,
            'games' => json_encode($randomCard->games),
            'highres_image' => $randomCard->highres_image == 'true',
            'illustration_id' => isset($randomCard->illustration_id) ? $randomCard->illustration_id : 0,
            'image_status' => $randomCard->image_status,
            'image_uris' => isset($randomCard->image_uris) ? json_encode($randomCard->image_uris) : json_encode(''),
            'prices' => json_encode($randomCard->prices),
            'printed_name' => isset($randomCard->printed_name) ? $randomCard->printed_name : '',
            'printed_text' => isset($randomCard->printed_text) ? $randomCard->printed_text : '',
            'printed_type_line' => isset($randomCard->printed_type_line) ? $randomCard->printed_type_line : '',
            'promo' => $randomCard->promo == 'true',
            'promo_types' => isset($randomCard->promo_types) ? json_encode($randomCard->promo_types) : json_encode(''),
            'purchase_uris' => json_encode($randomCard->purchase_uris),
            'rarity' => $randomCard->rarity,
            'related_uris' => json_encode($randomCard->related_uris),
            'released_at' => $randomCard->released_at,
            'reprint' => $randomCard->reprint == 'true',
            'scryfall_set_uri' => $randomCard->scryfall_set_uri,
            'set_name' => $randomCard->set_name,
            'set_search_uri' => $randomCard->set_search_uri,
            'set_type' => $randomCard->set_type,
            'set_uri' => $randomCard->set_uri,
            'set' => $randomCard->set,
            'set_id' => $randomCard->set_id,
            'scryfall_set_uri' => $randomCard->scryfall_set_uri,
            'story_spotlight' => $randomCard->story_spotlight == 'true',
            'textless' => $randomCard->textless == 'true',
            'variation' => $randomCard->variation == 'true',
            'watermark' => isset($randomCard->watermark) ? $randomCard->watermark : '',
            //
        ];
    }
}
