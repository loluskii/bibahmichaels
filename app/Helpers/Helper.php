<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper{

    public static function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }
}

?>
