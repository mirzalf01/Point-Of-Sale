<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    public function employees(){
        if (Auth::check()) {
            $employees = Employee::paginate(5);
            return view('employees/employee', ['employees' => $employees]);
        }
        else{
            return redirect('/login');
        }
    }
    
    public function empTambah(){
        if (Auth::check()) {
            return view('employees/tambah');
        }
        else{
            return redirect('/login');
        }
    }
    
    public function empTambahProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30',
            'email' => 'required',
            'role' => 'required'
        ]);
        $password = "employee123";
        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => $request->role,
        ]);

        return redirect('/employees');
    }

    public function hapus($id){
        $employees = Employee::find($id);
        $employees->delete();
        return redirect('/employees');
    }

    public function edit($id){
        $employees = Employee::find($id);
        return view('employees/edit', ['employees' => $employees]);
    }

    public function editProses(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30',
            'email' => 'required',
            'role' => 'required'
        ]);

        $id = $request->id;
        $employees  = Employee::find($id);
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->role = $request->role;
        $employees->save();
        return redirect('/employees');     
    }
    public function profile(){
        if (Auth::check()) {
            return view('employees/profile');
        }
        else{
            return redirect('/login');
        }
    }
    public function userEdit(Request $request){
        $this->validate($request,[
    		'name' => 'required|max:30',
            'email' => 'required',
            'phone' => 'numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $profile = Employee::find($request->id);
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        if ($profile->image === null) {
            $img = $request->file('image');
            $nama_img = $request->id."_".$img->getClientOriginalName();
            $tujuan_upload = 'profile';
            $img->move($tujuan_upload,$nama_img);
            $profile->image = $nama_img;
            $profile->save();
        } else {
            File::delete('profile/'.$profile->image);
            $img = $request->file('image');
            $nama_img = $request->id."_".$img->getClientOriginalName();
            $tujuan_upload = 'profile';
            $img->move($tujuan_upload,$nama_img);
            $profile->image = $nama_img;
            $profile->save();
        }
        return redirect('/user/profile');
    }
    public function changePass(Request $request){
        $this->validate($request,[
    		'new_password' => 'required|confirmed',
        ]);
        $user = Employee::find($request->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('alert', 'Updated!');
        } else {
            return redirect()->back()->with('alert', 'Wrong password');
        }
    }
}
