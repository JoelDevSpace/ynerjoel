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
        Schema::create('installateurs', function (Blueprint $table) {
            $table->id();
            $table->string('designation_juridique')->nullable();
            $table->string('nom_commercial')->nullable();
            $table->unsignedInteger('siret')->nullable();
            $table->unsignedMediumInteger('num_etablissement')->nullable();
            $table->string('numero_tva')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('site_web')->nullable();
            $table->boolean('actif')->default(true);
            $table->foreignId('modification_user_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(columns: 'modification_user_id')
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
        Schema::table('installateurs', function (Blueprint $table) {
            $table->dropForeign(['modification_user_id']);
            $table->dropConstrainedForeignIdFor('modification_user_id');
        });
        Schema::dropIfExists('installateurs');
    }
};
