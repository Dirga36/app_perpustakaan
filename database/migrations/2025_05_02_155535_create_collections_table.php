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
        Schema::create('collections', function (Blueprint $table) {
            $table->id('CollectionID')->primary()->autoIncrement();
            $table->foreignId('UserID')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('BookID')->constrained('books', 'BookID')->onDelete('cascade');
            $table->string('collectionName')->default('New Collection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi_pribadi');
        Schema::table('koleksi_pribadi', function (Blueprint $table) {
            $table->dropForeign(['UserID']);
            $table->dropForeign(['BukuID']);
        });
    }
};
