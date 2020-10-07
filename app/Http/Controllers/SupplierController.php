<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function suppliers(){
        if (Auth::check()) {
            $suppliers = Supplier::paginate(10);

            return view('suppliers/suppliers', ['suppliers' => $suppliers]);
        }
        else{
            return redirect('/login');
        }
    }

    public function supTambah(){
        if (Auth::check()) {
           return view('suppliers/tambah');
        }
        else{
            return redirect('/login');
        }
    }

    public function supTambahProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30',
            'phone' => 'required|max:13',
            'address' => 'required',
            'description' => 'required'
        ]);
        
        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description
        ]);

        return redirect('/suppliers');
    }

    public function hapus($id){
        if (Auth::check()) {
            $supplier = Supplier::find($id);
            $supplier -> delete();
            return redirect('/suppliers');
        }
        else{
            return redirect('/login');
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $supplier = Supplier::find($id);
            return view('suppliers/edit', ['supplier'=>$supplier]);
        }
        else{
            return redirect('/login');
        }
        
    }

    public function editproses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30',
            'phone' => 'required|max:13',
            'address' => 'required',
            'description' => 'required'
        ]);

        $id = $request->id;
        $supplier  = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->description = $request->description;
        $supplier->save();
        return redirect('/suppliers');      
    }
}
