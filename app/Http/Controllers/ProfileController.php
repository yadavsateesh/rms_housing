<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Str;
class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		$admin_id = auth()->user()->id;
		$admin = User::find($admin_id);
		
        return view('admin.profile.edit',compact('admin'));
    }
	
	public function update(Request $request)
    {
		$admin_id = auth()->user()->id;
		
        $data = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
			'email' => "required|email|unique:users,email,$admin_id,id",
        ]);
		
		$profile_image = $request->old_profile_image;
		
		if ($request->hasFile('profile_image'))
		{
			$profile_image = Str::uuid() . '.' . $request->profile_image->getClientOriginalExtension();
			$request->profile_image->storeAs('public/profile_image/', $profile_image);
			
			$profile_image = asset('storage/profile_image/' . $profile_image);
		}
		
		$admin = User::find($admin_id);
		$admin->name = $request->name;
		$admin->email = $request->email;
		//$admin->mobile_no = $request->mobile_no;
		//$admin->whatsapp_no = $request->whatsapp_no;
		$admin->profile_image = $profile_image;
		$admin->save();
		
        return redirect()->route('admin.profile')->with('success', 'Admin detail updated successfully');
    }
	
	public function changePassword()
    {
        return view('admin.profile.password');
    }
	
	public function changePasswordUpdate(Request $request)
    {
        $admin_id = auth()->user()->id;
		
        $data = $request->validate([
            'password' => "required",
            'confirm_password' => "required|same:password",
        ]);

        $admin = User::find($admin_id);
		$admin->password = Hash::make($request->password);
		$admin->save();

        return redirect()->route('admin.change.password')->with('success', 'Password changed successfully.');
    }
}
