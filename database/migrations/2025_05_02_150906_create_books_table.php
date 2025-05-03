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
        Schema::create('books', function (Blueprint $table) {
            $table->id('BookID')->primary()->autoIncrement();
            $table->timestamps();
            $table->string('title');
            $table->text('content');
            $table->string('author');
            $table->string('publisher');
            $table->date('publication_date');
            $table->enum('status', ['Available', 'Not_available'])->default('Available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
