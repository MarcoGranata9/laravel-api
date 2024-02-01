<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologysTableSeeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $techs = ['HTML', 'CSS', 'Javascript', 'php', 'vue', 'laravel'];
    
        foreach ($techs as $tech) {
            $newTechs = new Technology();
            $newTechs->name = $tech;
            $newTechs->hex_color = $faker->hexColor();
            $newTechs->save();
        }    
    }
}
