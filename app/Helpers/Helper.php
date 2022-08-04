<?php

namespace App\Helpers;

use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class Helper{

    public static function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }

    public static function currency_load(){
        if(session()->has('system_default_currency_info') == false ){
            session()->put('system_default_currency_info', Currency::findOrFail(1));
        }
    }

    public static function currency_converter($amount)
    {
        return convert_price($amount);
    }



}

if(!function_exists('convert_price ')){
    function convert_price($price){
        Helper::currency_load();
        $system_default_currency_info = session('system_default_currency_info');
        $price = floatval($price)/floatval($system_default_currency_info->exchange_rate);

        if(session()->has('currency_exchange_rate')){
            $exchange = session('currency_exchange_rate');
        }else{
            $exchange = $system_default_currency_info->exchange_rate;
        }

        $price = floatval($price) * floatval($exchange);

        return $price;
    }
}


if(!function_exists('currency_symbol')){
    function currency_symbol(){
        Helper::currency_load();
        if(session()->has('currency_symbol')){
            $symbol = session('currency_symbol');
        }else{
            $system_default_currency_info = session('system_default_currency_info');
            $symbol = $system_default_currency_info->symbol;
        }
        return $symbol;
    }
}


if(!function_exists('format_price')){
    function format_price($price){
        return currency_symbol(). number_format($price, 2);
    }
}

?>
