<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'sku' => 'SKU0123456',
            'slug'=> 'bukola-bodysuit',
            'name'=>'bukola bodysuit',
            'description'=>'Make a statement with this Exaggerated bell sleeve bodysuit, featuring overlapping neckline and African cotton wax long sleeve. Perfect for pairing with jean, pant, skirt and short for your everyday look, casual, brunch, date night and girls out look.',
            'additional_information'=>'Model wearing size M. Materials used are African cotton Wax, Spandex. We recommend you hand wash, do not bleach. Iron on low heat, and wash with similar colors. Note: It takes 5-7 working days as processing time for your piece. If you like an adjustment (shoulder, bust, waist, hip, arm e.t.c) to your order, kindly share your measurements in the notes section when you place order',
            'category_id'=>5,
            'price'=>60,

        ]);

        Product::create([
            'sku' => 'SKU0123451',
            'slug'=> 'lawunmi-bodysuit',
            'name'=>'lawunmi bodysuit',
            'description'=>'Make a statement with this Puff sleeve bodysuit, featuring deep cut V neckline and African cotton wax sleeve. Perfect for pairing with jean, pant, skirt and short for your everyday look, casual, brunch, date night and girls out look.',
            'additional_information'=>'Model wearing size M. Materials used are African cotton Wax, Spandex, elastic at sleeve to support grip. V-Boning at neckline to give structure. We recommend you hand wash, do not bleach. Iron on low heat, and wash with similar colors. Note: It takes 5-7 working days as processing time for your piece. If you like an adjustment (shoulder, bust, waist, hip, arm e.t.c) to your order, kindly share your measurements in the notes section when you place order',
            'category_id'=>5,
            'price'=>60,
        ]);

        

    }
}
