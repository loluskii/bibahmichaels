<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'user_id'=>1,
            'default'=>true,
            'shipping_fname'=> 'Test',
            'shipping_lname' => 'User',
            'shipping_email'=> 'test@email.com',
            'shipping_address'  => '14a, Test street, Mackington, Mamba',
            'shipping_city' => 'Mackington',
            'shipping_state' => 'Mamba',
            'shipping_country'=> 'Tookers',
            'shipping_phone' => '0012 345 3456',
            'shipping_zipcode'=> '220010',
        ]);
    }
}
