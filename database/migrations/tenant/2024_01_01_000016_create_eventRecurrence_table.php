<?php
// File: database/migrations/2024_01_01_000016_create_eventRecurrence_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventRecurrence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventId');
            $table->enum('frequency', ['daily', 'weekly', 'monthly']);
            $table->unsignedInteger('intervalValue')->default(1);
            $table->string('daysOfWeek', 20)->nullable();
            $table->unsignedInteger('dayOfMonth')->nullable();
            $table->date('recurrenceStartDate');
            $table->date('recurrenceEndDate')->nullable();
            $table->unsignedInteger('maxOccurrences')->nullable();
            $table->string('signature', 128);
            $table->timestamps();

            $table->foreign('eventId')->references('id')->on('events');

            $table->index(['recurrenceStartDate', 'recurrenceEndDate']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventRecurrence');
    }
};
