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
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662550600/bukola-bodysuit/gvaamzwsugoozdnkhtvy.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662550601/bukola-bodysuit/oefqxds0roo2xomiwg2b.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662550602/bukola-bodysuit/rohopjftzys5zgl7fiis.jpg',
        ]);
        Image::create([
            'product_id' => 1,
            'thumbnail'=> 'bukola-bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662550604/bukola-bodysuit/hwkhrb1mqsyeammldmyr.jpg',
        ]);


        Image::create([
            'product_id' => 11,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662549813/lawunmi-bodysuit/msvkvrujqbh9pjhsmkhy.jpg'
        ]);
        Image::create([
            'product_id' => 11,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662549814/lawunmi-bodysuit/mzjjeewhdnqonache7mc.jpg'
        ]);
        Image::create([
            'product_id' => 11,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662549815/lawunmi-bodysuit/fm8dfujvg7exrmnopety.jpg'
        ]);
        Image::create([
            'product_id' => 11,
            'thumbnail'=> 'lawunmi_bodysuit',
            'url'=>'https://res.cloudinary.com/hehvaxw20/image/upload/v1662549817/lawunmi-bodysuit/awqvhegabupapprd77ig.jpg'
        ]);
    }
}
