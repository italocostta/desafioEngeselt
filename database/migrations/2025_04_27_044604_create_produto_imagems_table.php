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
    Schema::create('produto_imagens', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produto_id')
              ->constrained('produtos')
              ->onDelete('cascade');
        $table->string('caminho'); // onde o arquivo ficará salvo
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_imagems');
    }
};
