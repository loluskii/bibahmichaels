<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\OrderQueries;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::count();
        $orders = Order::count();
        $sales = Order::sum('subtotal');
        $recent_orders = Order::latest()->take(10)->get();
        $users = User::count();
        $recent_users = User::latest()->take(10)->get();
        $gbp = OrderQueries::getMonthlyRevenuePounds();
        $usd = OrderQueries::getMonthlyRevenueDollars();
        $ngn = OrderQueries::getMonthlyRevenueNaira();
        // $chartSales = UserQueries::orderSalesJson();
        // $chartCustomers = UserQueries::userCountJson();

        return view('admin.dashboard.index',compact('products','sales','orders','recent_orders','users','recent_users','gbp','usd','ngn'));
    }
}
