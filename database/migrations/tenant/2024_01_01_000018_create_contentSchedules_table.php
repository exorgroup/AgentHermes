<?php
// File: database/migrations/2024_01_01_000018_create_contentSchedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contentSchedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viewId');
            $table->string('targetType');
            $table->unsignedBigInteger('targetId');
            $table->timestamp('startsAt');
            $table->timestamp('endsAt')->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'emergency'])->default('normal');
            $table->boolean('isActive')->default(true);
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();

            $table->foreign('viewId')->references('id')->on('views');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('viewId');
            $table->index(['targetType', 'targetId']);
            $table->index(['startsAt', 'endsAt']);
            $table->index(['priority', 'isActive']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contentSchedules');
    }
};
