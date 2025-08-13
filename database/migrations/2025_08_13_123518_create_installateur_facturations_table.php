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
        Schema::create('installateur_facturations', function (Blueprint $table) {
            $table->id();
            $table->string('condition_paiement')->unique();
            $table->foreignId('installateur_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('installateur_id')
                ->references('id')
                ->on('installateurs')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installateur_facturations', function (Blueprint $table) {
            $table->dropForeign(['installateur_id']);
            $table->dropConstrainedForeignIdFor('installateur_id');
        });
        Schema::dropIfExists('installateur_facturations');
    }
};
