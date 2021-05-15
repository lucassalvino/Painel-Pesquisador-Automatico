<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissao', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('entidade', 100);
            $table->string('acao', 150);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('permissao', function($table) {
            $table->index(['entidade']);
            $table->index(['acao']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissao');
    }
}
