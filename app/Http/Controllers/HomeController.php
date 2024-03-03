<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Models\User;
	use App\Models\Property;
	use App\Models\Visitor;
	
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
			//whether ip is from share internet
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   
			{
				$ip_address = $_SERVER['HTTP_CLIENT_IP'];
			}
			//whether ip is from proxy
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
			{
				$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			//whether ip is from remote address
			else
			{
				$ip_address = $_SERVER['REMOTE_ADDR'];
			}
			
			$visitor_ip_address = Visitor::where('ip',$ip_address)->first();
			if(empty($visitor_ip_address))
			{
				$visitor = new Visitor();
				$visitor->ip = $ip_address;
				$visitor->save();
			}
			
			$total_users = User::where('id', '!=', '1')->count();
			
			$total_properties = Property::count();
			
			$total_visitor = Visitor::count();
			
			$total_verified_properties = Property::where('is_verified', '!=', '0')->count();
			
			$result = Property::select('user_id')->pluck('user_id')->toArray();
			$get_visttor = User::whereNotIn('id',$result)->where('users.id', '!=', '1')->get()->count();
			
			$result = Property::select('user_id')->pluck('user_id')->toArray();
			$get_agent = User::whereIn('id',$result)->where('users.id', '!=', '1')->get()->count();
			
			return view('admin.dashboard',compact('total_users','total_properties','total_verified_properties','get_visttor','get_agent','total_visitor'));
		}
	}
