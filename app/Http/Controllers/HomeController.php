<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Supplier;
use App\Customer;
use App\Sales;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $item = Items::all();
        $supplier = Supplier::all();
        $sales = Sales::all();
        $customer = Customer::all();
        $cItem = count($item);
        $cSupplier = count($supplier);
        $cSales = count($sales);
        $cCustomer = count($customer);
        $sale = Sales::orderBy('created_at', 'desc')->limit(10)->get();

        return view('product/index', ['customer'=>$cCustomer, 'item'=>$cItem, 'supplier'=>$cSupplier, 'sale'=>$cSales, 'sales'=>$sale]);
    }
}
