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
        Schema::table('design', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->text('alamat')->nullable()->change();
            $table->text('nilai_kontrak')->nullable()->change();
            $table->date('waktu')->nullable()->change();
            $table->string('status_update')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('design', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
            $table->text('nilai_kontrak')->nullable(false)->change();
            $table->date('waktu')->nullable(false)->change();
            $table->string('status_update')->nullable(false)->change();
        });
    }
};
