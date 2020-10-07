<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;
use App\Units;
use App\Items;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{   
    /* Category Function */
    public function categories(){
        if (Auth::check()) {
            $categories = Categories::paginate(5);
            return view('products/categories', ['categories'=> $categories]);
        }
        else{
            return redirect('/login');
        }
    }

    public function catTambah(){
        if (Auth::check()) {
            return view('products/category/tambah');
        }
        else{
            return redirect('/login');
        }
    }

    public function catTambahProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30'
        ]);

        $categories = Categories::create([
            'name' => $request->name
        ]);

        return redirect('/products/categories');
    }

    public function catHapus($id){
        if (Auth::check()) {
            $categories = Categories::find($id);
            $categories->delete();

            return redirect('/products/categories');
        }
        else{
            return redirect('/login');
        }
    }

    public function catEdit($id){
        if (Auth::check()) {
            $categories = Categories::find($id);
            return view('products/category/edit', ['categories'=>$categories]);
        }
        else{
            return redirect('/login');
        }
    }

    public function catEditProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30'
        ]);

        $categories = Categories::find($request->id);
        $categories->name = $request->name;
        $categories->save();

        return redirect('/products/categories');
    }

    /* Unit Function */
    public function units(){
        if (Auth::check()) {
            $units = Units::paginate(5);

            return view('products/units', ['units'=>$units]);
        }
        else{
            return redirect('/login');
        }
    }

    public function unitTambah(){
        if (Auth::check()) {
            return view('products/unit/tambah');
        }
        else{
            return redirect('/login');
        }
    }

    public function unitTambahProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30'
        ]);

        $units = Units::create([
            'name' => $request->name
        ]);

        return redirect('/products/units');
    }

    public function unitHapus($id){
        if (Auth::check()) {
            $units = Units::find($id);
            $units->delete();

            return redirect('/products/units');
        }
        else{
            return redirect('/login');
        }
    }

    public function unitEdit($id){
        if (Auth::check()) {
            $units = Units::find($id);
            return view('products/unit/edit', ['units'=>$units]);
        }
        else{
            return redirect('/login');
        }
    }

    public function unitEditProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30'
        ]);

        $units = Units::find($request->id);
        $units->name = $request->name;
        $units->save();

        return redirect('/products/units');
    }

    /* Item Functions */
    public function items(){
        if (Auth::check()) {
            $items = Items::paginate(5);

            return view('products/items', ['items'=>$items]);
        }
        else{
            return redirect('/login');
        }
    }

    public function itemTambah(){
        if (Auth::check()) {
            $categories = Categories::all();
            $units = Units::all();

            return view('products/item/tambah', ['categories'=>$categories, 'units'=>$units]);
        }
        else{
            return redirect('/login');
        }
    }

    public function itemTambahProses(Request $request){
        $this->validate($request,[
            'name' => 'required|max:30',
            'category' => 'required|max:30',
            'unit' => 'required|max:30',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $items = items::create([
            'name' => $request->name,
            'category' => $request->category,
            'unit' => $request->unit,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('/products/items');
    }

    public function itemHapus($id){
        if (Auth::check()) {
            $items = Items::find($id);
            $items->delete();
            return redirect('/products/items');
        }
        else{
            return redirect('/login');
        }
    }

    public function itemEdit($id){
        if (Auth::check()) {
            $items = Items::find($id);
            $categories = Categories::all();
            $units = Units::all();
            return view('products/item/edit', ['items'=>$items, 'categories'=>$categories, 'units'=>$units]);
        }
        else{
            return redirect('/login');
        }
    }

    public function itemEditProses(Request $request){
        $this->validate($request,[ 
            'name' => 'required|max:30',
            'category' => 'required|max:30',
            'unit' => 'required|max:30',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $items = Items::find($request->id);
        $items->name = $request->name;
        $items->category = $request->category;
        $items->unit = $request->unit;
        $items->price = $request->price;
        $items->stock = $request->stock;
        $items->save();
        
        return redirect('/products/items');
    }
}
