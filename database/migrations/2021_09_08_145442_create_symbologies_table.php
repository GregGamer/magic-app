<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymbologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbologies', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->string('loose_variant')->nullable();
            $table->string('english');
            $table->boolean('transposable');
            $table->boolean('represents_mana');
            $table->bigInteger('cmc')->nullable();
            $table->boolean('appears_in_mana_costs');
            $table->boolean('funny');
            $table->json('colors');
            $table->json('gatherer_alternates')->nullable();
            $table->string('svg_uri')->nullable();

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
        Schema::dropIfExists('symbologies');
    }
}
