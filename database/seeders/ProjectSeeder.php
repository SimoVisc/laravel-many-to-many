<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();
        
        $type = Type::inRandomOrder()->first();

        for($i = 0; $i < 10; $i++ ){
        $new_project = new Project();
        $new_project->name= $faker->sentence();
        $new_project->description= $faker->text(800);
        $new_project->menager= $faker->lastName();
        $new_project->slug= Str::slug($new_project->name, '-');
        $new_project->type_id = ( rand(1, 3) === 1 ) ? null : $type->id;
        $new_project -> save();
        }
    }
}
