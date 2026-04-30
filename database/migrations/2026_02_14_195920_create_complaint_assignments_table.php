<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('complaint_assignments', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('complaint_id');
    $table->unsignedBigInteger('assigned_to');
    $table->unsignedBigInteger('assigned_by');

    $table->timestamp('assigned_at')->nullable();
    $table->timestamps();

    $table->foreign('complaint_id')
          ->references('id')
          ->on('complaints')
          ->onDelete('cascade');

    $table->foreign('assigned_to')
          ->references('id')
          ->on('users');

    $table->foreign('assigned_by')
          ->references('id')
          ->on('users');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_assignments');
    }
};
