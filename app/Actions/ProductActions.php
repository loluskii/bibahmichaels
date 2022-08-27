<?php
namespace App\Actions;

use Exception;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function create($request){
        return DB::transaction(function () use ($request) {
            $product = new Product;
            $product->sku = "SKU".rand(002030,989990);
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->additional_information = $request->additional_information;
            $product->save();

            if($request->has('attributes')){
                foreach($request->collect('attributes') as $value){
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $product->id;
                    $attribute->attribute_name = $value['attribute_name'];
                    $attribute->value = $value['value'];
                    $attribute->save();
                }

            }
            if($request->has('image')){
                // SaveProductImage::dispatch($request->file('image'),$product)




                foreach ($request->file('image') as $imagefile){
                    $filename = date('YmdHi').$imagefile->getClientOriginalName();
                    $imagefile->move(public_path('images/products/'.$product->slug), $filename);
                    // $path = $imagefile->storeOnCloudinary('bibahmichael/'.$product->slug);
                    $imageUrl =  $filename;
                    $image = new Image;
                    $image->product_id = $product->id;
                    $image->thumbnail = $product->slug;
                    $image->url = $imageUrl;
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
