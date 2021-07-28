<?php

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

            //Core Card Fields
            $table->integer('arena_id');
            $table->uuid('scryfall_id');  //id
            $table->string('lang');
            $table->uuid('oracle_id');
            $table->string('prints_search_uri');
            $table->string('rulings_uri');
            $table->string('scryfall_uri');
            $table->string('uri');

            //Gameplay Fields
            $table->string('card_faces')->nullable();
            $table->string('cmc');
            $table->string('color_identity');       // color_identity -> Array but is saved as json
            $table->string('color_indicator')->nullable();       // color_indicators -> Array but is saved as json
            $table->string('colors')->nullable();   // colors -> Array but is saved as json
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
            $table->string('produced_mana')->nullable();
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


            //Card Face Objects

            //Related Card Objects


            $table->date('released_at');
            $table->string('image_status');
            $table->string('image_uri_small');
            $table->string('image_uri_normal');
            $table->string('image_uri_large');
            $table->string('image_uri_png');
            $table->string('image_uri_art_crop');
            $table->string('image_uri_border_crop');
            $table->boolean('reserved');
            $table->boolean('reprint');
            $table->foreignUuid('set_id');
            $table->string('rarity');
            $table->text('flavor_text');
            $table->string('frame');
            $table->boolean('full_art');
            $table->boolean('textless');
            $table->string('prices_eur');
            $table->string('prices_eur_foil');
            $table->string('related_uris_gatherer');
            $table->string('related_uris_edhrec');
            $table->string('purchase_uris_cardmarket');

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
