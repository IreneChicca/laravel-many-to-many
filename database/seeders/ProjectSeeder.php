<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_projects = config('projects');

        $type_ids = Type::all()->pluck('id');

        $tech_ids = Technology::all()->pluck('id');

        foreach($_projects as $_project){

            $project = new Project();

            $project->type_id = $faker->randomElement($type_ids);
            $project->title= $_project['title'];
            $project->date= $_project['date'];
            $project->main_lang= $_project['main_lang'];
            $project->commit= $_project['commit'];
            $project->bonus= $_project['bonus'];

            $project->save(); 
            
            $project->technologies()->attach($faker->randomElements($tech_ids, rand(1,3)));
        }

    }
}