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
        Schema::create('releases', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('spotify_id')->unique();
            $table->string('name');
            $table->string('album_type');
            $table->integer('total_tracks');
            $table->date('release_date');
            $table->string('image');
            $table->json('artists');
            $table->string('uri');
            $table->string('href');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releases');
    }
};
