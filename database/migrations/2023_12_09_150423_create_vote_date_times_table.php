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
        Schema::create('vote_date_times', function (Blueprint $table) {
            $table->id();
            $table->string('position'); // String data type
            $table->date('start_date'); // Date data type
            $table->time('start_time'); // Time data type
            $table->date('end_date'); // Date data type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_date_times');
    }
};
