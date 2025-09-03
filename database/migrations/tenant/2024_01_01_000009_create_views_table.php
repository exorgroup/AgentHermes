
<?php
// File: database/migrations/2024_01_01_000009_create_views_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('dimX');
            $table->unsignedInteger('dimY');
            $table->boolean('loopCanvas')->default(true);
            $table->json('themeSettings')->nullable();
            $table->boolean('isActive')->default(true);
            $table->string('signature', 128);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdBy')->references('id')->on('users');

            $table->index('isActive');
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
