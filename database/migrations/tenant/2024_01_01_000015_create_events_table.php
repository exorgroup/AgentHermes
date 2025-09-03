<?php
// File: database/migrations/2024_01_01_000015_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('startDatetime')->nullable();
            $table->timestamp('endDatetime')->nullable();
            $table->string('timezone', 50)->default('UTC');
            $table->unsignedBigInteger('imageId')->nullable();
            $table->unsignedBigInteger('videoId')->nullable();
            $table->unsignedBigInteger('logoId')->nullable();
            $table->string('externalUrl', 500)->nullable();
            $table->text('qrCodeData')->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'emergency'])->default('normal');
            $table->boolean('isEmergency')->default(false);
            $table->boolean('isRecurring')->default(false);
            $table->unsignedBigInteger('meetingRoomId')->nullable();
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('imageId')->references('id')->on('mediaFiles');
            $table->foreign('videoId')->references('id')->on('mediaFiles');
            $table->foreign('logoId')->references('id')->on('mediaFiles');
            $table->foreign('meetingRoomId')->references('id')->on('meetingRooms');
            $table->foreign('createdBy')->references('id')->on('users');

            $table->index(['startDatetime', 'endDatetime']);
            $table->index('priority');
            $table->index('isEmergency');
            $table->index('meetingRoomId');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
