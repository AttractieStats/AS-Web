<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attraction_suggestions', function (Blueprint $table) {
            $table->boolean('rejected')->default(false)->after('approved');
        });
    }

    public function down(): void
    {
        Schema::table('attraction_suggestions', function (Blueprint $table) {
            $table->dropColumn('rejected');
        });
    }
};
