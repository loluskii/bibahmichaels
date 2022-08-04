<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'British Pound Sterling',
            'symbol' => '£',
            'exchange_rate' => 1,
            'code' => 'GBP',
            'icon'=>'🇬🇧'
        ]);

        Currency::create([
            'name' => 'Nigerian Naira',
            'symbol' => '₦',
            'exchange_rate' => 506.87,
            'code' => 'NGN',
            'icon'=>'🇳🇬'
        ]);

        Currency::create([
            'name' => 'US Dollar',
            'symbol' => '$',
            'exchange_rate' => 1.22,
            'code' => 'USD',
            'icon'=>'🇺🇸'
        ]);

    }
}
