<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Items;
use App\Supplier;
use App\StockOut;
use App\Customer;
use App\Cart;
use App\Sales;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /* Purchases Function */
    public function purchases(){
        $purchase = Purchase::orderBy('created_at', 'desc')->paginate(5);

        return view('transaction/purchases', ['purchase'=>$purchase]);
    }

    public function purTambah(){
        $items = Items::all();
        $supplier = Supplier::all();
        return view('transaction/purchase/tambah', ['items'=>$items, 'supplier'=>$supplier]);
    }

    public function purTambahProses(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'supplier' => 'required|max:30',
            'stock' => 'required|numeric',
        ]);
        $item = Items::find($request->id);
        $newStock = $request->stock + $item->stock;
        $item->stock = $newStock;
        $item->save();

        $purchase = Purchase::create([
            'name' => $item->name,
            'supplier' => $request->supplier,
            'stock' => $request->stock,
        ]);

        return redirect('/transaction/purchases');
    }

    public function getDetails($id = 0)
    {
        $data = Items::find($id);
        echo json_encode($data);

        exit;
    }
    public function purHapus($id){
        $purchase = Purchase::find($id);
        $items = Items::where('name', $purchase->name)->first();
        $items->stock = $items->stock - $purchase->stock;
        $items->save();

        $purchase->delete();
        return redirect('/transaction/purchases');
    }

    /* Stock Out Functions */
    public function stockout(){
        $stockout = StockOut::orderBy('created_at', 'desc')->paginate(5);

        return view('transaction/stockout', ['stockout'=>$stockout]);
    }

    public function stockoutTambah(){
        $items = Items::all();

        return view('transaction/out/tambah', ['items'=>$items]);
    }

    public function stockoutTambahProses(Request $request){
        $items = Items::find($request->id);
        $this->validate($request,[
            'id' => 'required',
        ]);
        $items = Items::find($request->id);
        $this->validate($request,[
            'detail' => 'required',
            'stock' => 'required|numeric|lte:'.$items->stock,
        ]);

        $stockout = StockOut::create([
            'name' => $items->name,
            'detail' => $request->detail,
            'stock' => $request->stock,
        ]);

        $items->stock = $items->stock-$request->stock;
        $items->save();

        return redirect('/transaction/stockout');
    }

    public function stockoutHapus($id){
        $stockout = StockOut::find($id);
        $items = Items::where('name', $stockout->name)->first();
        $items->stock = $items->stock + $stockout->stock;
        $items->save();

        $stockout->delete();
        return redirect('/transaction/stockout');
    }

    /* Sales Functions */
    public function sales(){
        $customer = Customer::all();
        $items = Items::all();
        $cart = Cart::all();
        $total = Cart::sum('total');
        return view('transaction/sales', ['customers'=>$customer, 'items'=>$items, 'cart'=>$cart, 'total'=>$total]);
    }
    public function salesProcess(Request $request){
        $customer = $request->customer;
        $totalPrice = Cart::sum('total');
        $cart = Cart::all();
        if($cart->count() == 0){
            return redirect('/transaction/sales');
        }
        else{
            $detail = "";
            if($request->detail == ""){
                $detail = "-";
            }
            else{
                $detail = $request->detail;
            }
            $totalDiscount = 0;
            foreach($cart as $i){
                $totalDiscount = $totalDiscount + ($i->discount*$i->qty);
            }
            $str1 = "INV".date('ymd');
            $findStr2 = Sales::where('invoice', 'like', '%' . $str1 . '%')->orderBy('created_at', 'desc')->first();
            if($findStr2 === null){
                $str1 = $str1."0001";
            }
            else{
                $findStr3 = $findStr2->invoice;
                $strNum = substr($findStr3, 9, 13);
                $strNum = $strNum+1;
                $str1 = $str1."".sprintf('%04s', $strNum);
            }
            $sales = Sales::create([
                'invoice' => $str1,
                'customer' => $customer,
                'discount' => $totalDiscount,
                'total' => $totalPrice,
                'detail' => $detail,
            ]);
            return view('transaction/sale/invoice', ['cart'=>$cart, 'sales'=>$sales]);
        }
    }
    public function invoicePrint($id){
        $sales = Sales::find($id);
        $cart = Cart::all();
        return view('transaction/sale/invoiceprint', ['cart'=>$cart, 'sales'=>$sales]);
    }
    public function invoiceProcess(){
        Cart::truncate();
        return redirect('/transaction/sales');
    }
    // cart Function
    public function cart(Request $request){
        $items = Items::find($request->id);
        $this->validate($request,[
            'id' => 'required',
        ]);
        $items = Items::find($request->id);
        $this->validate($request,[
            'qty' => 'required|numeric|lte:'.$items->stock,
        ]);
        $test = Cart::where('name', $items->name)->first();
        if($test === null){
            $cart = Cart::create([
                'name' => $items->name,
                'price' => $items->price,
                'qty' => $request->qty,
                'discount' => 0,
                'total' => $items->price*$request->qty,
            ]);
            $items->stock = $items->stock - $request->qty;
            $items->save();
            return redirect('/transaction/sales');
        }
        else{
            $cart = Cart::where('name', $items->name)->first();
            $cart->qty = $cart->qty + $request->qty;
            $cart->total = $cart->price * $cart->qty;
            $cart->save();
            $items->stock = $items->stock - $request->qty;
            $items->save();
            return redirect('/transaction/sales');
        }
    }
    public function cartHapus($id){
        $cart = Cart::find($id);
        $item = Items::where('name', $cart->name)->first();
        $item->stock = $item->stock + $cart->qty;
        $item->save();
        $cart->delete();
        return redirect('/transaction/sales');
    }
    public function cartClear(){
        $cart = Cart::all();
        foreach($cart as $i){
            $items = Items::where('name', $i->name)->first();
            $items->stock = $items->stock + $i->qty;
            $items->save();
        }
        Cart::truncate();
        return redirect('/transaction/sales');
    }
    public function getDetailsCart($id = 0)
    {
        $data = Cart::find($id);
        echo json_encode($data);
        exit;
    }
    public function cartEdit(Request $request){
        $cart = Cart::find($request->mid);
        $items = Items::where('name', $cart->name)->first();
        $max = $cart->qty+$items->stock;
        $this->validate($request,[
            'mqty' => 'required|numeric|lte:'.$max,
            'mdiscount' => 'numeric',
        ]);
        if($request->mqty >= $cart->qty){
            $items->stock = $items->stock - ($request->mqty-$cart->qty);
            $cart->qty = $request->mqty;
            $cart->discount = $cart->discount+$request->mdiscount;
            $cart->total = ($cart->price - $cart->discount)*$cart->qty;
            $cart->save();
            $items->save();
            return redirect('/transaction/sales');
        }
        else{
            $items->stock = $items->stock + ($cart->qty-$request->mqty);
            $cart->qty = $request->mqty;
            $cart->discount = $cart->discount+$request->mdiscount;
            $cart->total = ($cart->price - $cart->discount)*$cart->qty;
            $cart->save();
            $items->save();
            return redirect('/transaction/sales');
        }
    }
}
