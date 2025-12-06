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
    Schema::create('histories', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('image_path')->nullable();
        
        // Info User (Nama & ID)
        $table->string('reporter_name'); // Nama Pelapor (Snapshot)
        $table->unsignedBigInteger('reporter_id')->nullable(); // ID Pelapor (Untuk Link)
        
        $table->string('resolver_name'); // Nama Penemu (Snapshot)
        $table->unsignedBigInteger('resolver_id')->nullable(); // ID Penemu (Untuk Link)
        
        $table->text('completion_note');
        $table->dateTime('completed_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
