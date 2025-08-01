<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->string('adressable_type');
            $table->integer('adressable_id');
            $table->string('type');
            $table->string('adresse');
            $table->string('adresse_complement')->nullable();
            $table->string('lieu_dit')->nullable();
            $table->string('code_postal');
            $table->string('ville');
            $table->string('pays')->nullable();
            $table->string('parcelle_cadastrale_1')->nullable();
            $table->string('parcelle_cadastrale_2')->nullable();
            $table->string('parcelle_cadastrale_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
