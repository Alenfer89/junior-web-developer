<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CharacterFilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $films_ids = Film::pluck('id')->toArray();
        
        $characters = Character::all();
        //dd($characters);

        foreach($characters as $character){
            //dd($character);
            $character->films()->sync($faker->randomElements($films_ids, rand(1, count($films_ids))));
        }
    }
}
