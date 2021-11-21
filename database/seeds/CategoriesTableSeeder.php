<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([

            'name' => 'Ordinateur',
            'slug' =>  'ordinateur',
        ]);
        Category::create([

            'name' => 'Téléphone',
            'slug' =>  'téléphone',
        ]);
        Category::create([

            'name' => 'Livre',
            'slug' =>  'livre',
        ]);
        Category::create([

            'name' => 'jeu',
            'slug' =>  'jeu',
        ]);
        Category::create([

            'name' => 'Tv',
            'slug' =>  'tv', 
        ]);
    }
}
