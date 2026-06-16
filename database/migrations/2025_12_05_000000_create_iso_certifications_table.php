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
        Schema::create('iso_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_id')->nullable();
            $table->text('description')->nullable();
            $table->text('description_id')->nullable();
            $table->text('image');
            $table->integer('order')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iso_certifications');
    }
};
