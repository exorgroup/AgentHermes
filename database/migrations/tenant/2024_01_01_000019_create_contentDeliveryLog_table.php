<?php
// File: database/migrations/2024_01_01_000019_create_contentDeliveryLog_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contentDeliveryLog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displayId');
            $table->string('contentType');
            $table->unsignedBigInteger('contentId');
            $table->timestamp('deliveredAt')->useCurrent();
            $table->timestamp('acknowledgedAt')->nullable();
            $table->enum('status', ['pending', 'delivered', 'failed', 'acknowledged'])->default('pending');
            $table->text('errorMessage')->nullable();
            $table->string('signature', 128);

            $table->foreign('displayId')->references('id')->on('displays');

            $table->index(['displayId', 'status']);
            $table->index('deliveredAt');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contentDeliveryLog');
    }
};
