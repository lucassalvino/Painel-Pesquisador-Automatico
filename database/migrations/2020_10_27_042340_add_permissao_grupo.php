<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissaoGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissao_grupo', function(Blueprint $table){
            $table->uuid('grupo_id');
            $table->uuid('permissao_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('permissao_grupo', function(Blueprint $table){
            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('permissao_id')->references('id')->on('permissao');
            $table->primary(['grupo_id', 'permissao_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('permissao_grupo');
    }
}
