<?php

namespace Database\Factories;

use App\Models\RawCard;
use Illuminate\Support\Facades\Http;
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
        $randomCard = Http::get('https://api.scryfall.com/cards/random')->object();

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
            'all_parts' => $randomCard->all_parts != "" ? $randomCard->all_parts : "",
            'card_faces' => $randomCard->card_faces != "" ? $randomCard->card_faces : "",
            'cmc' => $randomCard->cmc,
            'color_identity' => $randomCard->color_identity,
            'color_indicator' => $randomCard->color_indicator != "" ? $randomCard->color_indicator : "",
            'colors' => $randomCard->colors,
            'edhrec_rank' => $randomCard->edhrec_rank,
            'foil' => $randomCard->foil,
            'hand_modifiers' => $randomCard->hand_modifiers,
            'keywords' => $randomCard->keywords,
            'layout' => $randomCard->layout,
            'legalities' => $randomCard->legalities,
            'life_modifiers' => $randomCard->life_modifiers,
            'loyalty' => $randomCard->loyality,
            'mana_cost' => $randomCard->mana_cost,
            'name' => $randomCard->name,
            'nonfoil' => $randomCard->nonfoil,
            'oracle_text' => $randomCard->oracle_text,
            'oversized' => $randomCard->oversized,
            'power' => $randomCard->power,
            'produced_mana' => $randomCard->produced_mana,
            'reserved' => $randomCard->reserved,
            'toughness' => $randomCard->toughness,
            'type_line' => $randomCard->type_line,

            //Print Fields
            'artist' => $randomCard->artist,
            'booster' => $randomCard->booster,
            'border_color' => $randomCard->border_color,
            'card_back_id' => $randomCard->card_back_id,
            'collector_number' => $randomCard->collector_number,
            'content_warning' => $randomCard->content_warning,
            'digital' => $randomCard->digital,
            'flavor_name' => $randomCard->flavor_name,
            'flavor_text' => $randomCard->flavor_text,
            'frame_effects' => $randomCard->frame_effects,
            'frame' => $randomCard->frame,
            'full_art' => $randomCard->full_art,
            'games' => $randomCard->games,
            'highres_image' => $randomCard->highres_image,
            'illustration_id' => $randomCard->illustration_id,
            'image_status' => $randomCard->image_status,
            'image_uris' => $randomCard->image_uris,
            'prices' => $randomCard->prices,
            'printed_name' => $randomCard->printed_name,
            'printed_text' => $randomCard->printed_text,
            'printed_type_line' => $randomCard->printed_type_line,
            'promo' => $randomCard->promo,
            'promo_types' => $randomCard->promo_types,
            'purchase_uris' => $randomCard->purchase_uris,
            'rarity' => $randomCard->rarity,
            'related_uris' => $randomCard->related_uris,
            'released_at' => $randomCard->released_at,
            'reprint' => $randomCard->reprint,
            'scryfall_set_uri' => $randomCard->scryfall_set_uri,
            'set_name' => $randomCard->set_name,
            'set_search_uri' => $randomCard->set_search_uri,
            'set_type' => $randomCard->set_type,
            'set_uri' => $randomCard->set_uri,
            'set' => $randomCard->set,
            'set_id' => $randomCard->set_id,
            'scryfall_set_uri' => $randomCard->scryfall_set_uri,
            'story_spotlight' => $randomCard->story_spotlight,
            'textless' => $randomCard->textless,
            'variation' => $randomCard->variation,
            'watermark' => $randomCard->watermark,
            //
        ];
    }
}
