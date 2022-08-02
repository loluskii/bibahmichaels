<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;


class ProductQueries{
    public function getLatestProducts(){
        $products = Product::orderBy('id', 'desc')->take(8)->get();
        return $products;
    }

}


?>
