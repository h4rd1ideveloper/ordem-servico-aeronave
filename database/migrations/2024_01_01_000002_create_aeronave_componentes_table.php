<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aeronave_componentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_servico_id')->constrained('ordem_servicos')->onDelete('cascade');
            $table->string('tipo'); // AIRFRAME, LEFT ENGINE, RIGHT ENGINE, LEFT PROPELLER, RIGHT PROPELLER
            $table->string('serial_number')->nullable();
            $table->string('modelo')->nullable();
            $table->string('fabricante')->nullable();
            $table->integer('ano_fabricacao')->nullable();
            $table->string('tsn')->nullable(); // Time Since New
            $table->string('tso')->nullable(); // Time Since Overhaul
            $table->string('revisao')->nullable();
            $table->string('cso')->nullable(); // Cycles Since Overhaul
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aeronave_componentes');
    }
};

