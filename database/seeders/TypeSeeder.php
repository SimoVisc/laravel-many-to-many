<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // cancello tutti i dati della tabella type
        Schema::disableForeignKeyConstraints();
        type::truncate();
        Schema::enableForeignKeyConstraints();
       

        $types = [
            'Business implementation',
            'Foundational (business improvement)',
            'IT infrastructure improvement',
            'Physical engineering/construction',
            'Physical infrastructure improvement',
            'Procurement',
            'Regulatory/compliance',
            'Research and Development (R&D)',
            'Service development',
            'Transformation/reengineering'
        ];
        

        foreach ($types as $type) {
            $new_type = new Type();
            $new_type ->name= $type;
            $new_type ->slug= Str::slug($new_type->name);
            $new_type ->save();
        }
    }
}
