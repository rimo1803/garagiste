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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('mecanicNotes')->nullable();
            $table->text('clientNotes')->nullable();
            $table->foreignId('mecanicId')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehiculeId')->constrained('vehicule')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
