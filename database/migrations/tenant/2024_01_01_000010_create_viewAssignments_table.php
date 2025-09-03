<?php
// File: database/migrations/2024_01_01_000010_create_viewAssignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('viewAssignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viewId');
            $table->unsignedBigInteger('groupId');
            $table->timestamp('startsAt')->nullable();
            $table->timestamp('endsAt')->nullable();
            $table->boolean('isActive')->default(true);
            $table->unsignedBigInteger('assignedBy')->nullable();
            $table->string('signature', 128);
            $table->timestamps();

            $table->foreign('viewId')->references('id')->on('views');
            $table->foreign('groupId')->references('id')->on('displayGroups');
            $table->foreign('assignedBy')->references('id')->on('users');

            $table->index(['isActive', 'startsAt', 'endsAt']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viewAssignments');
    }
};
