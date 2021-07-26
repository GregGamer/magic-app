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
            $table->string('scryfall_uuid')->unique();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('scryfall_uri');
            $table->date('released_at');
            $table->string('set_type');
            $table->integer('card_count');
            $table->string('parent_set_code')->nullable();
            $table->string('icon_svg_uri');
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
