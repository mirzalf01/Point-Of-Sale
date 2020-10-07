<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customers(){
        if (Auth::check()) {
            $customer = Customer::paginate(5);
            return view('customers/customers', ['customer' => $customer]);
        }
        else{
            return redirect('/login');
        }
    }

    public function cusTambah(){
        if (Auth::check()) {
            return view('customers/tambah');
        }
        else{
            return redirect('/login');
        }
    }
    
    public function cusTambahProses(Request $request){
        $this->validate($request,[
            'name' => 'required|max:30',
            'gender' => 'required|max:1',
            'phone' => 'required|max:13',
            'address' => 'required'
        ]);

        Customer::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect('/customers');
    }

    public function hapus($id){
        if (Auth::check()) {
            $customer = Customer::find($id);
            $customer->delete();

            return redirect('/customers');
        }
        else{
            return redirect('/login');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $customer = Customer::find($id);
            return view('customers/edit', ['customer' => $customer]);
        }
        else{
            return redirect('/login');
        }
    }

    public function editProses(Request $request){
        $this->validate($request,[
            'name' => 'required|max:30',
            'gender' => 'required|max:1',
            'phone' => 'required|max:13',
            'address' => 'required'
        ]);

        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect('/customers');

    }
}
