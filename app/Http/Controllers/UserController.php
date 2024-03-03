<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;

class UserController extends Controller
{
    public function index($user_type)
    {
		if($user_type == 'visitor')
		{
			return view('admin.user.visitorlist');
		}
		if($user_type == 'agent')
		{
			return view('admin.user.agentlist');	
		}
    }
	
	public function visttorList()
    {
		//$get_users= User::join('properties', 'properties.user_id', '!=', 'users.id')->where('users.id', '!=', '1')->get();
		$result = Property::select('user_id')->pluck('user_id')->toArray();
		$get_users = User::whereNotIn('id',$result)->where('users.id', '!=', '1')->get();
		
        return datatables()->of($get_users)
			->addIndexColumn()
			->addColumn('action', function($data){
			
				$user_status = ($data->is_block == 1) ? '<a href="' . route('user.change-status',[$data->id,'no_block']) . '" class="verified" onclick="return confirm("Are you sure you want to unverified this property ?");"><i class="fa fa-unlock"></i></a>' : '<a href="' . route('user.change-status',[$data->id,'block']) . '" class="icon__2" onclick="return confirm("Are you sure you want to block this user ?");"><i class="fa fa-lock"></i></a>';
				
				return '
				<a href="' . route('user.show',$data->id) . '" class="icon__3"><i class="fa fa-eye"></i></a>'.$user_status;
			})
				
			->editColumn('is_block', function($data){
				return $data->is_block == 1 ? '<span class="badge light badge-danger">Block</span>' : '<span class="badge light badge-success">Unblock</span>';
			})
			
			->editColumn('created_at', function($data){
				return date('Y-m-d H:i:s', strtotime($data->created_at));
			})
			->rawColumns(['is_block','action'])
			->make(true);
	}
	
	public function agentList()
    {
		$result = Property::select('user_id')->pluck('user_id')->toArray();
		$get_users = User::whereIn('id',$result)->where('users.id', '!=', '1')->get();
		
        return datatables()->of($get_users)
			->addIndexColumn()
			->addColumn('action', function($data){
				$user_status = ($data->is_block == 1) ? '<a href="' . route('user.change-status',[$data->id,'no_block']) . '" class="verified" onclick="return confirm("Are you sure you want to unverified this property ?");"><i class="fa fa-unlock"></i></a>' : '<a href="' . route('user.change-status',[$data->id,'block']) . '" class="icon__2" onclick="return confirm("Are you sure you want to block this user ?");"><i class="fa fa-lock"></i></a>';
				
				return '
				<a href="' . route('user.show',$data->id) . '" class="icon__3"><i class="fa fa-eye"></i></a>'.$user_status;
			})
			
			->editColumn('is_block', function($data){
				return $data->is_block == 1 ? '<span class="badge light badge-danger">Block</span>' : '<span class="badge light badge-success">Unblock</span>';
			})
			
			->editColumn('created_at', function($data){
				return date('Y-m-d H:i:s', strtotime($data->created_at));
			})
			->rawColumns(['is_block','action'])
			->make(true);
	}
	
	public function show($id)
	{
		$user = User::find($id);
		
		return view('admin.user.view', compact('user'));
	}
	
	public function delete($id)
	{
		$user = User::find($id);
		$user->delete();
		return redirect()->back()->with('success', 'User deleted successfully.');
		
	}
	
	public function userBlock($id,$status)
	{
		$user = User::find($id);
		
		if($status == 'block')
		{
			$user->is_block = '1';
			$user->save();
		}
		else
		{
			$user->is_block = '0';
			$user->save();
		}
		
		//return redirect()->route('user.visitorlist')->with('success', 'Property updated successfully.');
		return redirect()->back()->with('success', 'Property updated successfully.');   
	}
}
