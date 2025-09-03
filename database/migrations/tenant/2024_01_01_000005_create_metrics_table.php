<?php
// File: database/migrations/2024_01_01_000005_create_metrics_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric', 100)->unique();
            $table->string('unit', 20)->nullable();
            $table->text('description')->nullable();
            $table->decimal('warningThreshold', 10, 4)->nullable();
            $table->decimal('criticalThreshold', 10, 4)->nullable();
            $table->boolean('isSystem')->default(true);
            $table->string('signature', 128);
            $table->timestamps();

            $table->index('isSystem');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
