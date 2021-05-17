<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigosExternosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artigo_externos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('titulo', 500);
            $table->string('path_arquivo', 300);
            $table->integer('ano');
            $table->uuid('idioma_id');
            $table->uuid('usuario_id');
            $table->boolean('processado')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('idioma_id')->references('id')->on('idioma');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artigo_externos');
    }
}
