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
        Schema::create('fosts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('libelle');
            $table->mediumText('denomination')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->foreignId('modification_user_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('modification_user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fosts', function (Blueprint $table) {
            $table->dropForeign(['modification_user_id']);
            $table->dropConstrainedForeignIdFor('modification_user_id');
        });
        Schema::dropIfExists('fosts');
    }
};
