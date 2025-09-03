<?php
// File: database/migrations/2024_01_01_000013_create_canvasComponents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvasComponents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('canvasId');
            $table->unsignedBigInteger('componentTypeId');
            $table->string('name');
            $table->unsignedInteger('gridColumnStart');
            $table->unsignedInteger('gridColumnEnd');
            $table->unsignedInteger('gridRowStart');
            $table->unsignedInteger('gridRowEnd');
            $table->integer('zIndex')->default(1);
            $table->json('configuration')->nullable();
            $table->boolean('isVisible')->default(true);
            $table->string('signature', 128);
            $table->timestamps();

            $table->foreign('canvasId')->references('id')->on('canvases');
            $table->foreign('componentTypeId')->references('id')->on('componentTypes');

            $table->index('canvasId');
            $table->index('zIndex');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvasComponents');
    }
};
