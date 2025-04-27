<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('confeitarias', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('telefone')->nullable();
        $table->string('cep', 9);
        $table->string('rua');
        $table->string('numero');
        $table->string('bairro');
        $table->string('cidade');
        $table->string('estado', 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confeitarias');
    }
};
