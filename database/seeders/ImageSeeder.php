<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'feyi-dress1',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341534/bibahmichael/1_fdfsmh.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'feyi-dress1',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341507/bibahmichael/2_vtlf5d.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'feyi-dress1',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341594/bibahmichael/3_q7cvrv.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'feyi-dress1',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341561/bibahmichael/4_iswbas.jpg',
        ]);


        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_dress1',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659363057/bibahmichael/Product%202/2_1_n6diwx.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_dress2',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659363057/bibahmichael/Product%202/2_2_kscruo.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_dress3',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659363057/bibahmichael/Product%202/2_3_hyk3vm.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_dress4',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659363055/bibahmichael/Product%202/2_4_b462xh.jpg',
        ]);
    }
}
