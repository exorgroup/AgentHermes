<?php
// File: database/migrations/2024_01_01_000011_create_canvases_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viewId');
            $table->string('name');
            $table->unsignedInteger('durationTime')->nullable();
            $table->unsignedInteger('canvasOrder')->default(1);
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('viewId')->references('id')->on('views');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('viewId');
            $table->index(['viewId', 'canvasOrder']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvases');
    }
};
