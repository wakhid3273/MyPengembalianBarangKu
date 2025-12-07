<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->foreignId('reporter_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('item_name');
            $table->text('description');
            $table->string('location_found');
            $table->date('date_found');
            $table->time('time_found');
            $table->string('photo_url'); // Path: items/{kategori}/{item_id}_{item_name}.jpg
            $table->enum('status', ['available', 'claimed', 'returned'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};