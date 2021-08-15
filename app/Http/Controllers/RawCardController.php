<?php

namespace App\Http\Controllers;

use App\Models\RawCard;
use Illuminate\Http\Request;

class RawCardController extends Controller
{
    //
    public static function store_RawCard_By_RawCardObject($rawCard)
    {
        $card = new RawCard();

        //Core Fields
        $card->scryfall_id = $rawCard->id;
        $card->lang = $rawCard->lang;
        $card->oracle_id = $rawCard->oracle_id;
        $card->prints_search_uri = $rawCard->prints_search_uri;
        $card->rulings_uri = $rawCard->rulings_uri;
        $card->scryfall_uri = $rawCard->scryfall_uri;
        $card->uri = $rawCard->uri;

        //Gameplay Fields
        $card->all_parts = isset($rawCard->all_parts) ? json_encode($rawCard->all_parts) : json_encode('');
        $card->card_faces = isset($rawCard->card_faces) ? json_encode($rawCard->card_faces) : json_encode('');
        $card->cmc = $rawCard->cmc;
        $card->color_identity = json_encode($rawCard->color_identity);
        $card->color_indicator = isset($rawCard->color_indicator) ? json_encode($rawCard->color_indicator) : json_encode('');
        $card->colors = isset($rawCard->colors) ? json_encode($rawCard->colors) : json_encode('');
        $card->edhrec_rank = isset($rawCard->edhrec_rank) ? $rawCard->edhrec_rank : 0;
        $card->foil = $rawCard->foil == 'true';
        $card->hand_modifier = isset($rawCard->hand_modifier) ? $rawCard->hand_modifier : '';
        $card->keywords = json_encode($rawCard->keywords);
        $card->layout = $rawCard->layout;
        $card->legalities = json_encode($rawCard->legalities);
        $card->life_modifier = isset($rawCard->life_modifier) ? $rawCard->life_modifier : '';
        $card->loyalty = isset($rawCard->loyality) ? $rawCard->loyality : '';
        $card->mana_cost = isset($rawCard->mana_cost) ? $rawCard->mana_cost : '';
        $card->name = $rawCard->name;
        $card->nonfoil = $rawCard->nonfoil == 'true';
        $card->oracle_text = isset($rawCard->oracle_text) ? $rawCard->oracle_text : '';
        $card->oversized = $rawCard->oversized == 'true';
        $card->power = isset($rawCard->power) ? $rawCard->power : '';
        $card->produced_mana = isset($rawCard->produced_mana) ? json_encode($rawCard->produced_mana) : json_encode('');
        $card->reserved = $rawCard->reserved == 'true';
        $card->toughness = isset($rawCard->toughness) ? $rawCard->toughness : '';
        $card->type_line = $rawCard->type_line;

        //Print Fields
        $card->artist = isset($rawCard->artist) ? $rawCard->artist : '';
        $card->booster = $rawCard->booster == 'true';
        $card->border_color = $rawCard->border_color;
        $card->card_back_id = $rawCard->card_back_id;
        $card->collector_number = $rawCard->collector_number;
        //$card->content_warning = $rawCard->content_warning;
        $card->digital = $rawCard->digital == 'true';
        $card->flavor_name = isset($rawCard->flavor_name) ? $rawCard->flavor_name : '';
        $card->flavor_text = isset($rawCard->flavor_text) ? $rawCard->flavor_text : '';
        $card->frame_effects = isset($rawCard->frame_effects) ? json_encode($rawCard->frame_effects) : json_encode('');
        $card->frame = $rawCard->frame;
        $card->full_art = isset($rawCard->full_art) ? $rawCard->full_art == 'true' : false;
        $card->games = json_encode($rawCard->games);
        $card->highres_image = $rawCard->highres_image == 'true';
        $card->illustration_id = isset($rawCard->illustration_id) ? $rawCard->illustration_id : 0;
        $card->image_status = $rawCard->image_status;
        $card->image_uris = isset($rawCard->image_uris) ? json_encode($rawCard->image_uris) : json_encode('');
        $card->prices = json_encode($rawCard->prices);
        $card->printed_name = isset($rawCard->printed_name) ? $rawCard->printed_name : '';
        $card->printed_text = isset($rawCard->printed_text) ? $rawCard->printed_text : '';
        $card->printed_type_line = isset($rawCard->printed_type_line) ? $rawCard->printed_type_line : '';
        $card->promo = $rawCard->promo == 'true';
        $card->promo_types = isset($rawCard->promo_types) ? json_encode($rawCard->promo_types) : json_encode('');
        $card->purchase_uris = json_encode($rawCard->purchase_uris);
        $card->rarity = $rawCard->rarity;
        $card->related_uris = json_encode($rawCard->related_uris);
        $card->released_at = $rawCard->released_at;
        $card->reprint = $rawCard->reprint == 'true';
        $card->scryfall_set_uri = $rawCard->scryfall_set_uri;
        $card->set_name = $rawCard->set_name;
        $card->set_search_uri = $rawCard->set_search_uri;
        $card->set_type = $rawCard->set_type;
        $card->set_uri = $rawCard->set_uri;
        $card->set = $rawCard->set;
        $card->set_id = $rawCard->set_id;
        $card->scryfall_set_uri = $rawCard->scryfall_set_uri;
        $card->story_spotlight = $rawCard->story_spotlight == 'true';
        $card->textless = $rawCard->textless == 'true';
        $card->variation = $rawCard->variation == 'true';
        $card->watermark = isset($rawCard->watermark) ? $rawCard->watermark : '';

        $card->save();
    }
}
