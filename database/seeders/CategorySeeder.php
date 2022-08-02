<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'Jumpsuits',
                'slug' => 'jumpsuits',
            ],
            [
                'name' => 'Dresses',
                'slug' => 'dresses',
            ],
            [
                'name' => 'Skirts',
                'slug' => 'skirts',
            ],
            [
                'name' => 'Pants',
                'slug' => 'pants',
            ],
            [
                'name' => 'Tops',
                'slug' => 'tops',
            ],
            [
                'name' => 'Kimonos',
                'slug' => 'kimonos',
            ],
            [
                'name' => 'Kaftan',
                'slug' => 'kaftan',
            ],

        ];
        DB::table('categories')->insert($category);
    }
}
