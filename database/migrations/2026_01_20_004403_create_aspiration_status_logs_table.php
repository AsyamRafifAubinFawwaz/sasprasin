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
        Schema::create('aspiration_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aspiration_id');
            $table->tinyInteger('old_status')->nullable();
            $table->tinyInteger('new_status');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('changed_by');
            $table->timestamp('created_at')->useCurrent();

            // Foreign keys (optional, but good practice if tables exist)
            // $table->foreign('aspiration_id')->references('id')->on('aspirations')->onDelete('cascade');
            // $table->foreign('changed_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspiration_status_logs');
    }
};
