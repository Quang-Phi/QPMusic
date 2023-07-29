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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('img_url');
            $table->string('url');
            $table->string('musician')->default('No Information');
            $table->longtext('lyric')->default('No Information')->nullable();
            $table->time('duration')->default('00:00:00')->nullable();
            $table->tinyInteger('status')->default(2)->comment("1:Old, 2:New, 3:Coming soon");
            $table->longtext('description')->default('No Description')->nullable();
            $table->date('release_date')->nullable();
            $table->double('downloads')->default(0);
            $table->index(['name']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
