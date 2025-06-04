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
        Schema::create('reviews', function (Blueprint $table) {
            //serve para melhorar performance e segurança das tabelas
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('rating');
            $table->text('comment');
            $table->unsignedBigInteger('bookuser_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();
            $table->foreign('bookuser_id')->references('id')->on('book_users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
