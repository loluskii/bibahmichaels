<?php

namespace Database\Seeders;

use App\Models\Custom;
use Illuminate\Database\Seeder;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Custom::create([
            'fname' => 'Charlie',
            'lname' => 'Puth',
            'email' => 'charlieputh@email.com',
            'occassion' => 'Best Man at a Wedding Ceremony',
            'event_date' => '24th September, 2022',
            'measurements' => 'chest: 42cm, trouser: 121cm, waist: 29cm, arm-length: 32cm, biceps: 40cm',
            'order_description' => 'I need a properly designed suit. I have attached a sample to this request. ',
            'budget' => '500-600',
            'image' => ''
        ]);
    }
}
