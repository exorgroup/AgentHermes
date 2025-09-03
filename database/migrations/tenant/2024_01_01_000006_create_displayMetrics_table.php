
<?php
// File: database/migrations/2024_01_01_000006_create_displayMetrics_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('displayMetrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('displayId');
            $table->unsignedBigInteger('metricId');
            $table->decimal('value', 10, 4);
            $table->timestamp('recordedAt')->useCurrent();
            $table->string('signature', 128);

            $table->foreign('displayId')->references('id')->on('displays');
            $table->foreign('metricId')->references('id')->on('metrics');

            $table->index(['displayId', 'recordedAt']);
            $table->index('recordedAt');
            $table->index(['displayId', 'metricId']);
            $table->index('signature');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('displayMetrics');
    }
};
