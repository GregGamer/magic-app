<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardFacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_faces', function (Blueprint $table) {
            $table->id();
            $table->string('artist');
            $table->json('color_indicator');
            $table->json('colors');
            $table->string('flavour_text');
            $table->uuid('illustration_id');
            $table->json('image_uris');
            $table->string('loyalty');
            $table->string('mana_cost');
            $table->string('name');
            $table->string('object');
            $table->string('oracle_text');
            $table->string('power');
            $table->string('printed_name');
            $table->string('printed_text');
            $table->string('printed_type_line');
            $table->string('toughness');
            $table->string('type_line');
            $table->string('watermark');
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
        Schema::dropIfExists('card_faces');
    }
}
