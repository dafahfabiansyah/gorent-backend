<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('booking_transactions', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->string('phone_number');
    //         $table->string('booking_trx_id');
    //         $table->boolean('is_paid');
    //         $table->date('started_at');
    //         $table->date('ended_at');
    //         $table->unsignedInteger('total_amount');
    //         $table->unsignedInteger('duration');
    //         $table->foreignId('office_space_id')->constrained()->cascadeOnDelete();
    //         $table->string('invoice');
    //         $table->softDeletes();
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
{
    if (!Schema::hasTable('cities')) {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
