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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('studnum')->unique();
            $table->string('firstname');
            $table->string('midname')->nullable();
            $table->string('lastname');
            $table->string('contact');
            $table->string('sex');
            $table->string('year');
            $table->string('section');
            $table->dateTime('reported_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
