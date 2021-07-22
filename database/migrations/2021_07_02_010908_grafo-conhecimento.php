<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GrafoConhecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vertice', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('descricao', 300);
            $table->integer('tipo')->default(0);// 0 para origem extração
            $table->uuid('artigo_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('artigo_id')->references('id')->on('artigo_externos');
        });

        Schema::create('aresta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('descricao', 300);
            $table->uuid('origem_id');
            $table->uuid('destino_id');
            $table->uuid('artigo_id');
            $table->integer('tipo')->default(0);// 0 para origem extração
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('origem_id')->references('id')->on('vertice');
            $table->foreign('destino_id')->references('id')->on('vertice');
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
        Schema::dropIfExists('vertice');
    }
}
