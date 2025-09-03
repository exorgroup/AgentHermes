<?php
// File: database/migrations/2024_01_01_000017_create_eventAssignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventAssignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventId');
            $table->string('assignableType');
            $table->unsignedBigInteger('assignableId');
            $table->unsignedBigInteger('assignedBy')->nullable();
            $table->string('signature', 128);
            $table->timestamps();

            $table->foreign('eventId')->references('id')->on('events');
            $table->foreign('assignedBy')->references('id')->on('users');

            $table->index(['assignableType', 'assignableId']);
            $table->index('eventId');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventAssignments');
    }
};
