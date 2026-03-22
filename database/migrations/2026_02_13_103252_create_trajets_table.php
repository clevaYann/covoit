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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time_depart'); 
            $table->dateTime('date_time_arrivee'); 
        
            // Relation "Conduit" (Voiture) [cite: 33]
            $table->foreignId('voiture_id')->constrained('voitures')->onDelete('cascade');
        
            // Relations CampusDepart et CampusArrive 
            $table->foreignId('campus_depart_id')->constrained('campuses');
            $table->foreignId('campus_arrive_id')->constrained('campuses');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
