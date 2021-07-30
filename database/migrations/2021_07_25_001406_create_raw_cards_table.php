<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_cards', function (Blueprint $table) {
            $table->id();

            /* Table Fields
             * Integer: integer
             * String: string
             * UUID: uuid
             * Array: json
             * Object: json
             * URI: string
             * Decimal: decimal
             * Colors: json
             * Boolean: boolean
             * Date: date
             */

            //Core Card Fields
            //$table->uuid('arena_id')->nullable();
            $table->uuid('scryfall_id');        //this is in the api the 'id' it is the only field, that has a different name
            $table->string('lang');
            //$table->integer('mtgo_id')->nullable();
            //$table->integer('mtgo_foil_id')->nullable();
            //$table->json('multiverse_ids')->nullable();
            //$table->integer('tcgplayer_id')->nullable();
            //$table->integer('cardmarket_id')->nullable();
            //$table->string('object');
            $table->uuid('oracle_id');
            $table->string('prints_search_uri');
            $table->string('rulings_uri');
            $table->string('scryfall_uri');
            $table->string('uri');

            //Gameplay Fields
            $table->json('all_parts')->nullable();
            $table->string('card_faces')->nullable();
            $table->string('cmc');
            $table->json('color_identity');       // color_identity -> Array but is saved as json
            $table->json('color_indicator')->nullable();       // color_indicators -> Array but is saved as json
            $table->json('colors')->nullable();   // colors -> Array but is saved as json
            $table->integer('edhrec_rank')->nullable();
            $table->boolean('foil');
            $table->string('hand_modifiers')->nullable();               // for Vanguard cards
            $table->json('keywords');               // Keywords -> Array but is saved as json
            $table->string('layout');               // Layouts: normal, split, flip, transform, ...
            $table->json('legalities');
            $table->string('life_modifier')->nullable();               // for Vanguard cards
            $table->string('loyalty')->nullable();
            $table->string('mana_cost')->nullable();
            $table->string('name');
            $table->boolean('nonfoil');
            $table->text('oracle_text')->nullable();
            $table->boolean('oversized');
            $table->string('power')->nullable();
            $table->json('produced_mana')->nullable();
            $table->boolean('reserved');
            $table->string('toughness')->nullable();
            $table->string('type_line');

            //Print Fields
            $table->string('artist')->nullable();
            $table->boolean('booster');
            $table->string('border_color');
            $table->uuid('card_back_id');
            $table->string('collector_number');
            $table->boolean('content_warning')->nullable();
            $table->boolean('digital');
            $table->string('flavor_name')->nullable();
            $table->string('flavor_text')->nullable();
            $table->json('frame_effects')->nullable();
            $table->string('frame');
            $table->boolean('full_art')->nullable();
            $table->json('games');
            $table->boolean('highres_image');
            $table->uuid('illustration_id')->nullable();
            $table->string('image_status');
            $table->json('image_uris')->nullable();
            $table->json('prices');
            $table->string('printed_name')->nullable();
            $table->string('printed_text')->nullable();
            $table->string('printed_type_line')->nullable();
            $table->boolean('promo');
            $table->json('promo_types')->nullable();
            $table->json('purchase_uris');
            $table->string('rarity');
            $table->json('related_uris');
            $table->date('released_at');
            $table->boolean('reprint');
            $table->string('scryfall_set_uri');
            $table->string('set_name');
            $table->string('set_search_uri');
            $table->string('set_type');
            $table->string('set_uri');
            $table->string('set');
            $table->string('set_id');
            $table->boolean('story_spotlight');
            $table->boolean('textless');
            $table->boolean('variation');
            $table->string('watermark')->nullable();
            //$table->date('preview.previewed_at')->nullable();
            //$table->string('preview.source_uri')->nullable();
            //$table->string('preview.source')->nullable();


            //Card Face Objects
            // is in the other data as json implimented: card_faces

            //Related Card Objects
            // is in the other data as json implimented: all_parts


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raw_cards');
    }
}
