<?php
// File: database/migrations/2024_01_01_000008_create_mediaFiles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mediaFiles', function (Blueprint $table) {
            $table->id();
            $table->string('originalName');
            $table->string('storedName');
            $table->string('filePath', 500);
            $table->string('mimeType', 100);
            $table->unsignedBigInteger('fileSize');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('duration')->nullable();
            $table->string('checksum', 64);
            $table->string('signature', 128);
            $table->unsignedBigInteger('uploadedBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uploadedBy')->references('id')->on('users');

            $table->index('checksum');
            $table->index('mimeType');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mediaFiles');
    }
};
