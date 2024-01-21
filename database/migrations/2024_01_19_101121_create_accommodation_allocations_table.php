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
        Schema::create('accommodation_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id');
            $table->foreignId('accommodation_id');
            $table->foreignId('status_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('added_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('status_changed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_allocations');
    }
};
