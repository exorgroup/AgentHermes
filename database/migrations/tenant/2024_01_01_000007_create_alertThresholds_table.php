<?php
// File: database/migrations/2024_01_01_000007_create_alertThresholds_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alertThresholds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displayId');
            $table->unsignedBigInteger('metricId');
            $table->decimal('warningThreshold', 10, 4)->nullable();
            $table->decimal('criticalThreshold', 10, 4)->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();

            $table->foreign('displayId')->references('id')->on('displays');
            $table->foreign('metricId')->references('id')->on('metrics');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->unique(['displayId', 'metricId']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertThresholds');
    }
};
