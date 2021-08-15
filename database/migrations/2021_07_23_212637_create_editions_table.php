<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('scryfall_id')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('set_type');
            $table->date('released_at')->nullable();
            $table->string('block_code')->nullable();
            $table->string('block')->nullable();
            $table->string('parent_set_code')->nullable();
            $table->integer('card_count');
            $table->boolean('digital');
            $table->boolean('foil_only');
            $table->boolean('nonfoil_only');
            $table->string('scryfall_uri');
            $table->string('uri');
            $table->string('icon_svg_uri');
            $table->string('search_uri');

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
        Schema::dropIfExists('editions');
    }
}
