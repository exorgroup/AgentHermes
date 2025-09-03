<?php
// File: database/migrations/2024_01_01_000014_create_meetingRooms_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetingRooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('locationId')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->text('equipment')->nullable();
            $table->unsignedBigInteger('mapImageId')->nullable();
            $table->unsignedBigInteger('imageId')->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('locationId')->references('id')->on('locations');
            $table->foreign('mapImageId')->references('id')->on('mediaFiles');
            $table->foreign('imageId')->references('id')->on('mediaFiles');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('name');
            $table->index('locationId');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetingRooms');
    }
};
