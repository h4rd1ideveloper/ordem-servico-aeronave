<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('servico_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_servico_id')->constrained('ordem_servicos')->onDelete('cascade');
            $table->integer('numero_item');
            $table->text('descricao');
            $table->string('equipe')->nullable();
            $table->string('intervalo')->nullable();
            $table->string('horas')->nullable();
            $table->string('ciclos')->nullable();
            $table->string('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servico_itens');
    }
};

