<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.catalog.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        try{
            $category = new Category;
            $category->name = $request->name;
            $category->slug = str_replace('-', ' ', $request->name); ;
            $category->save();

            return back()->with('success', 'Category added successfully');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function view_products($id)
    {
        $products = Product::where('category_id',$id)->get();
        return view('admin.catalog.categories.show', compact('products'));
    }

    public function edit(Request $request, $id)
    {
        try{
            DB::beginTransaction();
                $category = Category::find($id);
                $category->name = $request->name ?? $category->name;
                $category->slug = $request->slug ?? $category->slug;
                $category->save();
            DB::commit();

            return back()->with(
                'success',
                'Category updated successfully'
            );

        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function delete($id)
    {
        $id->delete();
        return back()->with('success','Deleted successfully');
    }
}
