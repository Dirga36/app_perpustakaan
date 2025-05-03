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
            $table->id('ReviewID')->primary()->autoIncrement();
            $table->foreignId('BookID')->constrained('books', 'BookID')->onDelete('cascade');
            $table->foreignId('UserID')->constrained('users', 'id')->onDelete('cascade');
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan-buku');
        Schema::table('ulasan-buku', function (Blueprint $table) {
            $table->dropForeign(['BukuID']);
            $table->dropForeign(['UserID']);
        });
    }
};
