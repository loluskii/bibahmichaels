<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function currencyIndex()
    {
        $currencies = Currency::all();
        return view('admin.settings.currency.index', compact('currencies'));
    }

    public function addCurrency(Request $request){
        try {
            $currency = new Currency;
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->exchange_rate = $request->exchange_rate;
            $currency->code = $request->code;
            $currency->icon = $request->icon;
            $currency->save();

            return back()->with('success','Currency Added successfully!');

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function editCurrency(Request $request, $id)
    {
        try{
            DB::beginTransaction();
                $currency = Currency::find($id);
                $currency->name = $request->name;
                $currency->symbol = $request->symbol;
                $currency->exchange_rate = $request->exchange_rate;
                $currency->code = $request->code;
                $currency->icon = $request->icon;
                $currency->slug = $request->slug ?? $currency->slug;
                $currency->save();
            DB::commit();
            return back()->with('success','Product updated!');

        }catch(\Exception $e){
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function deleteCurrency($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return back()->with('success','Deleted successfully');
    }
}
