<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_os');
            $table->string('aeronave_matricula');
            $table->date('data_inicio');
            $table->date('termino_previsto');
            $table->string('empresa_nome')->default('MTX Aviation Manutenção De Aeronaves Ltda');
            $table->string('empresa_endereco')->default('Sorocaba/SP - CUM 20130641/ANAC');
            $table->string('documento_codigo')->default('F-TEC 015 REV03');
            $table->date('documento_data')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordem_servicos');
    }
};

