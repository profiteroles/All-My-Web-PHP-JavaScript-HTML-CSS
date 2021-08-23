<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedGenres = [
            [
                'name' => 'Alternative',
                'description' => 'PsyTrance',
                'picture' => 'alternative-psytrance.png',
            ], [
                'name' => 'Rock',
                'description' => 'Damn Rock & Roll',
                'picture' => 'rock-icon.png',
            ], [
                'name' => 'Blues',
                'description' => 'Pink Blues',
                'picture' => 'pink-blue.png',
            ], [
                'name' => 'Electronic',
                'description' => 'More PsyTrance',
                'picture' => 'psy-icon.png',
            ],
        ];

        foreach ($seedGenres as $seed){
            Genre::create($seed);
        }
    }
}
