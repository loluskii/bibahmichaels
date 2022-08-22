<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Actions\ProductActions;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $category = Category::all();
        return view('admin.catalog.products.index', compact('products','category'));
    }

    public function create(Request $request)
    {

        try {
            $res = ProductActions::create($request);
            if($res){
                return back()->with(
                    'success',
                    'Product added successfully'
                );
            }else{
                return back()->with('error','Please add an image!');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        try{
            $res = ProductActions::update($request, $id);
            if ($res){
                return back()->with('success','Product updated!');
            }else{
                return back()->with('error','An error occured');
            }
        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function destroy(Product $id)
    {
        $id->delete();
        $res = File::deleteDirectory(public_path('products/'.$id->slug));
        return back()->with('success','Deleted successfully');
    }
}
