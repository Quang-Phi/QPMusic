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
        Schema::create('users_info', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('No Information');
            $table->string('address')->default('No Information')->nullable();
            $table->string('phone')->default('No Information')->nullable();
            $table->tinyInteger('gender')->default(1)->nullable()->comment("1:Male, 2:Female");
            $table->string('avatar')->default('https://i.postimg.cc/CMqt7f1Z/image.png')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_info');
    }
};
