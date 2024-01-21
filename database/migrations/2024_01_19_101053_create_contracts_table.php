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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('contract_number');
            $table->foreignId('status_id');
            $table->foreignId('travel_agent_id');
            $table->enum('exclusive',['yes','no']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('added_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('status_changed_by')->nullable();
            $table->text('description');
            $table->string('standard_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
