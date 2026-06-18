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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->text('maps_url')->nullable()->after('alamat');
            $table->decimal('latitude', 10, 8)->nullable()->after('maps_url');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->text('description')->nullable()->after('longitude');
            $table->string('nib_file')->nullable()->after('nib_number');
            $table->string('halal_certificate_file')->nullable()->after('halal_certificate_number');
            $table->json('operational_hours')->nullable()->after('halal_certificate_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn([
                'maps_url',
                'latitude',
                'longitude',
                'description',
                'nib_file',
                'halal_certificate_file',
                'operational_hours',
            ]);
        });
    }
};
