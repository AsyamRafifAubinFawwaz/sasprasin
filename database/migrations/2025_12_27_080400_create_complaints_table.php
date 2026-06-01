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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('facility_category_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('facility_category_id')->references('id')->on('facility_categories')->onUpdate('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
