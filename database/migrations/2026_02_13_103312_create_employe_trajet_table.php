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
        Schema::create('employe_trajet', function (Blueprint $table) {
            $table->foreignId('employe_id')->constrained('employes')->onDelete('cascade');
            $table->foreignId('trajet_id')->constrained('trajets')->onDelete('cascade');
            $table->dateTime('date_inscription');
            $table->primary(['employe_id','trajet_id', 'date_inscription' ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_trajet');
    }
};
