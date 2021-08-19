<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DoiArtigo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_pesquisa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('descricao', 300);
        });

        Schema::table('artigo_externos', function(Blueprint $table){
            $table->string('doi', 300)->nullable();
            $table->uuid('base_pesquisa_id')->nullable();
            $table->foreign('base_pesquisa_id')->references('id')->on('base_pesquisa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artigo_externos', function(Blueprint $table){
            $table->dropColumn('doi');
            $table->dropForeign('base_pesquisa_id');
            $table->dropColumn('base_pesquisa_id');
        });
        Schema::dropIfExists('base_pesquisa');
    }
}
