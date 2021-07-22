<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntidadesArtigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidades_artigo', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('entidade', 255);
            $table->uuid('artigo_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('artigo_id')->references('id')->on('artigo_externos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidades_artigo');
    }
}
