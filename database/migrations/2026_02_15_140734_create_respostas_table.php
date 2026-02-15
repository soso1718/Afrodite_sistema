<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->integer('idade')->nullable();
            $table->string('ciclo_regular')->nullable();
            $table->string('data_ultima_menstruacao')->nullable();

            $table->json('objetivo')->nullable();
            $table->string('objetivo_outro')->nullable();

            $table->string('saude_importante')->nullable();

            $table->string('hormonios')->nullable();
            $table->json('hormonios_tipo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas');
    }
};
