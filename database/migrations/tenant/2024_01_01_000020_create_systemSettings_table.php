<?php
// File: database/migrations/2024_01_01_000020_create_systemSettings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('systemSettings', function (Blueprint $table) {
            $table->id();
            $table->string('settingKey')->unique();
            $table->text('settingValue');
            $table->enum('settingType', ['string', 'integer', 'boolean', 'json'])->default('string');
            $table->text('description')->nullable();
            $table->boolean('isPublic')->default(false);
            $table->string('signature', 128);
            $table->unsignedBigInteger('updatedBy')->nullable();
            $table->timestamps();

            $table->foreign('updatedBy')->references('id')->on('users');

            $table->index('isPublic');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systemSettings');
    }
};
