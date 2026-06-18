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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_pemilik');
            $table->string('nama_restoran');
            $table->string('email')->unique();
            $table->string('whatsapp', 20);
            $table->string('kategori'); // Pempek, Tekwan, Mie Celor, Laksan, etc.
            $table->text('alamat');
            $table->json('photos')->nullable(); // Array of file paths
            $table->string('nib_number')->nullable();
            $table->string('halal_certificate_number')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
