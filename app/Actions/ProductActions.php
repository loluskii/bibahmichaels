<?php
namespace App\Actions;

use Exception;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function create($request){
        return DB::transaction(function () use ($request) {
            $product = new Product;

            $product->save();
            if($request->has('image')){
                foreach ($request->file('image') as $imagefile){
                    $path = $imagefile->storeOnCloudinary($product->tag_number);
                    $imageUrl =  $path->getSecurePath();
                    $image = new ProductImage;
                    $image->product_id = $product->id;
                    $image->image_url = $imageUrl;
                    $image->save();
                }
                return true;
            }else{
                return false;
            }
        });
    }

    public static function update($request, $id){
        return DB::transaction(function () use ($request, $id) {

            return true;
        });
    }

}
?>
