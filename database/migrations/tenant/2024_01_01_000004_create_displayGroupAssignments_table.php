<?php
// File: database/migrations/2024_01_01_000004_create_displayGroupAssignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('displayGroupAssignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displayId');
            $table->unsignedBigInteger('groupId');
            $table->timestamp('assignedAt')->useCurrent();
            $table->unsignedBigInteger('assignedBy')->nullable();
            $table->string('signature', 128);

            $table->foreign('displayId')->references('id')->on('displays');
            $table->foreign('groupId')->references('id')->on('displayGroups');
            $table->foreign('assignedBy')->references('id')->on('users');

            $table->unique(['displayId', 'groupId']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('displayGroupAssignments');
    }
};
