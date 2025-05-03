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
        Schema::create('category_relations', function (Blueprint $table) {
            $table->id('CategoryRelationID');
            $table->foreignId('CategoryID')->constrained('book_categories', 'CategoryID')->onDelete('cascade');
            $table->foreignId('BookID')->constrained('books', 'BookID')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoribuku-relasi');
        Schema::table('kategoribuku-relasi', function (Blueprint $table) {
            $table->dropForeign(['KategoriID']);
            $table->dropForeign(['BukuID']);
        });
    }
};
