<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('variant_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')
                ->constrained('variants')
                ->onDelete('cascade')
                ->onUpdate('cascade'); // Jika variant diupdate, ikut update
            $table->string('name'); // Contoh: Merah, Biru, S, M, L
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variant_options');
    }
};
