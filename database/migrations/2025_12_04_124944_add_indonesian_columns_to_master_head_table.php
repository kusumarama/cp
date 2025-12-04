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
        Schema::table('master_head', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('title');
            $table->text('subtitle_id')->nullable()->after('subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_head', function (Blueprint $table) {
            $table->dropColumn(['title_id', 'subtitle_id']);
        });
    }
};
