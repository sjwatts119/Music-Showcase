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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('playlist_owners');
            $table->string('spotify_id')->unique();
            $table->string('name');
            $table->text('description');
            $table->boolean('collaborative');
            $table->string('href');
            $table->string('primary_color')->nullable();
            $table->boolean('public');
            $table->string('snapshot_id');
            $table->integer('tracks');
            $table->string('uri');
            $table->integer('followers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};
