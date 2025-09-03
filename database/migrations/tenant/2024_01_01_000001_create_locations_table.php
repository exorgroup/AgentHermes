<?php
// File: database/migrations/2024_01_01_000001_create_locations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->unsignedBigInteger('parentLocationId')->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parentLocationId')->references('id')->on('locations');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('parentLocationId');
            $table->index('name');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
