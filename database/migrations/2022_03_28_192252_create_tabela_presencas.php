<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_presencas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf')->unsigned();
            $table->foreign('cpf')->references('tabela_funcionarios')->on('cpf');
            $table->dateTime('data_presenca');
            $table->boolean('presente');
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
        Schema::dropIfExists('tabela_presencas');
    }
};
