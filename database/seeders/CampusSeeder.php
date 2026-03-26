<?php

namespace Database\Seeders;

use App\Models\Campuse;
use App\Models\Employe;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campuses = Campuse::factory()->count(4)->create();

        // Repartir proprement les affiliations avant de reseeder.
        Employe::all()->each(function ($employe) {
            $employe->campuses()->detach();
        });

        $totalEmployes = Employe::count();
        $nombreAvecCampus = max(1, (int) floor($totalEmployes * 0.7));

        $employesAvecCampus = Employe::inRandomOrder()->limit($nombreAvecCampus)->get();

        $employesAvecCampus->each(function ($employe) use ($campuses) {
            $campus = $campuses->random();
            $employe->campuses()->syncWithoutDetaching([$campus->id]);
        });
    }
}
