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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('user_name'); // Nama Pemosting
        $table->enum('status', ['kehilangan', 'menemukan']);
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('titipkan_ke');
        $table->string('whatsapp')->nullable();
        $table->string('instagram')->nullable();
        $table->dateTime('time');
        $table->string('image_path');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
