<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attraction_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained('attraction_types')->onDelete('cascade');
            $table->string('park_id');
            $table->string('photo_path')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attraction_suggestions');
    }
};
