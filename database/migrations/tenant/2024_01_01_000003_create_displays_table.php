<?php
// File: database/migrations/2024_01_01_000003_create_displays_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('macAddress', 17)->unique();
            $table->enum('orientation', ['landscape', 'portrait'])->default('landscape');
            $table->unsignedInteger('screenWidth')->nullable();
            $table->unsignedInteger('screenHeight')->nullable();
            $table->string('osVersion', 100)->nullable();
            $table->unsignedBigInteger('locationId')->nullable();
            $table->unsignedBigInteger('imageId')->nullable();
            $table->string('gpsPosition', 100)->nullable();
            $table->timestamp('lastSeenAt')->nullable();
            $table->enum('status', ['online', 'offline', 'maintenance'])->default('offline');
            $table->text('notes')->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('locationId')->references('id')->on('locations');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('macAddress');
            $table->index('status');
            $table->index('lastSeenAt');
            $table->index('locationId');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('displays');
    }
};
