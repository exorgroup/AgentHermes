
<?php
// File: database/migrations/2024_01_01_000002_create_displayGroups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('displayGroups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('timezone', 50)->default('UTC');
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('name');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('displayGroups');
    }
};
