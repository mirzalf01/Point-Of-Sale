<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use File;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /* Sales Function */
    public function sales(){
        if (Auth::check()) {
            $sales = Sales::orderBy('created_at', 'desc')->paginate(5);
            $number = 0;
            return view('report/sales', ['sales'=>$sales, 'number'=>$number]);
        }
        else{
            return redirect('/login');
        }
    }
    public function reportfilter(Request $request){
        if (Auth::check()) {
            $invoice = Sales::where('invoice','like',"%".$request->customer."%")->orderBy('created_at', 'desc')->paginate();
            return view('report/sales', ['sales'=>$invoice]);
        }
        else{
            return redirect('/login');
        }
    }
    public function invDownload($invoice){
        if (Auth::check()) {
            $file=Storage::disk('public/invoice')->get($invoice);
 
		    return (new Response($file, 200))
              ->header('Content-Type', 'application/pdf');
        }
        else{
            return redirect('/login');
        }
    }
}
