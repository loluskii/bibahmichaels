<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttribute::create([
            'product_id' => 1,
            'attribute_name' => 'size',
            'value' => 'XL'
        ]);

        ProductAttribute::create([
            'product_id' => 1,
            'attribute_name' => 'size',
            'value' => 'L'
        ]);

        ProductAttribute::create([
            'product_id' => 1,
            'attribute_name' => 'size',
            'value' => 'M'
        ]);
        ProductAttribute::create([
            'product_id' => 1,
            'attribute_name' => 'size',
            'value' => 'S'
        ]);
        ProductAttribute::create([
            'product_id' => 1,
            'attribute_name' => 'color',
            'value' => 'black'
        ]);
        ProductAttribute::create([
            'product_id' => 2,
            'attribute_name' => 'color',
            'value' => 'black'
        ]);
        ProductAttribute::create([
            'product_id' => 2,
            'attribute_name' => 'size',
            'value' => 'XL'
        ]);

        ProductAttribute::create([
            'product_id' => 2,
            'attribute_name' => 'size',
            'value' => 'L'
        ]);

        ProductAttribute::create([
            'product_id' => 2,
            'attribute_name' => 'size',
            'value' => 'M'
        ]);
        ProductAttribute::create([
            'product_id' => 2,
            'attribute_name' => 'size',
            'value' => 'S'
        ]);
    }
}
