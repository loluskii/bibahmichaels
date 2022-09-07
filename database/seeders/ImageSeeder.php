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
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341534/bibahmichael/1_fdfsmh.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341507/bibahmichael/2_vtlf5d.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341594/bibahmichael/3_q7cvrv.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/deumzc82y/image/upload/v1659341561/bibahmichael/4_iswbas.jpg',
        ]);


        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662544933/lawunmi-bodysuit/2_1_fohr0k.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662544929/lawunmi-bodysuit/2_2_klku6y.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662544931/lawunmi-bodysuit/2_3_hyofs1.jpg',
        ]);
        Image::create([
            'product_id' => 2,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662544927/lawunmi-bodysuit/2_4_x6vybn.jpg',
        ]);
    }
}
