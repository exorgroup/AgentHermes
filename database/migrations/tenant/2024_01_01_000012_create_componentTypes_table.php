<?php
// File: database/migrations/2024_01_01_000012_create_componentTypes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('componentTypes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('displayName');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('isSystem')->default(false);
            $table->json('configurationSchema')->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();

            $table->index('isSystem');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('componentTypes');
    }
};
