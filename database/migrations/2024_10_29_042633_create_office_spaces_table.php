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
        Schema::create('office_spaces', function (Blueprint $table) {
            $table->id();
            // name of office
            $table->string('name');
            // image thumbnail for office
            $table->string('thumbnail');
            $table->string('address');
            // check office is open or close
            $table->boolean('is_open');
            // as booked, check if the office is available
            $table->boolean('is_available');
            // show price of office
            $table->unsignedInteger('price');
            // show duration using this office
            $table->unsignedInteger('duration');
            // refrence to city table in database
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            // as about
            $table->text('description');
            // slug for endpoint in url
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_spaces');
    }
};
