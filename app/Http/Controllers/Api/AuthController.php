<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Str;

class AuthController extends Controller
{
   /*  public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
		
        if ($validator->fails())
		{
            $messages = $validator->errors()->messages();
			
			foreach ($messages as $key => $value)
			{
				$error[] = $value[0];
			}
			
            return response()->json($error, 406);
        }
		else
		{
			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
			{
				$user = User::find(Auth::guard('web')->user()->id);
				$user->user_session_token = Hash::make(rand(1111 , 9999).rand(1111 , 9999));
				$user->device_token = $request->device_token;
				$user->save();
				
				return response()->json(['message' => 'Login successfully', 'data' => $user], 200);
				//return response()->json(['message' => 'Login Successfully'], 200);
			}
			else
			{
				return response()->json(['Credentials Does not Match !'], 406);
			}
		}
	} */
	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'mobile_no' => 'required',
        ]);
		
        if ($validator->fails())
		{
            $messages = $validator->errors()->messages();
			
			foreach ($messages as $key => $value)
			{
				$error[] = $value[0];
			}
			
            return response()->json($error, 406);
        }
		else
		{
			$user = User::where('mobile_no',$request->mobile_no)->first();
			
			if($user)
			{	
					$user = User::find($user->id);
					$user->user_session_token = Hash::make(rand(1111 , 9999).rand(1111 , 9999));
					$user->device_token = $request->device_token;
					/*$user->device_os = $request->device_os;
					$user->device_os_version = $request->device_os_version;
					$user->device_model = $request->device_model; */
					//$user->last_login_at = date("Y-m-d H:i:s");
					
					if(app()->environment('production'))
					{
						$user->otp = rand(1111, 9999);
					}
					else
					{
						$user->otp = '1234';
					}
					$user->is_otp_verified = 0;
					$user->save();
					
					return response()->json(['message' => 'OTP Send Successfully', 'data' => $user], 200);
			}
			else
			{
				//Create User      
				$user = new User();
				$user->mobile_no = $request->mobile_no;
				$user->user_type = "user";
				$user->user_session_token = Hash::make(rand(1111 , 9999).rand(1111 , 9999));
				$user->device_token = $request->device_token;
				if(app()->environment('production'))
				{
					$user->otp = rand(1111, 9999);
				}
				else
				{
					$user->otp = '1234';
				}
				
				$user->is_otp_verified = '0';
				$user->save();
				
				return response()->json(['message' => 'User Create Successfully And OTP Send Successfully', 'data' => $user], 200);
			}
		}
	}
	
	public function verifyOtp(Request $request)
    {	
		$validator = Validator::make($request->all(), [
            'mobile_no' => 'required|exists:users,mobile_no',
            'otp' => 'required',
        ]);
		
        if ($validator->fails())
		{
            $messages = $validator->errors()->messages();
			
			foreach ($messages as $key => $value)
			{
				$error[] = $value[0];
			}
			
            return response()->json($error, 406);
        }
		else
		{		
			$user = User::where(['mobile_no' =>$request->mobile_no,'otp' => $request->otp])->first();
			
			if ($user)
			{
				$user = User::find($user->id);
				$user->otp = NULL;
				$user->is_otp_verified = '1';
				$user->save();
				return response()->json(['message' => 'OTP Verify Successfully', 'data' => $user], 200);
			}
			else
			{
				return response()->json(['OTP Does not Match !'], 406);
			}
		}
    }
	
	public function logout(Request $request)
	{
		$user_id = $request->get('user_id');
		
		$user = User::find($user_id);
		$user->device_token = NULL;
		$user->user_session_token = NULL;
		$user->save();
		
		return response()->json(['message' => 'Logout successfully'], 200);
	}
	
	function changePasswordUpdate(Request $request)
	{
		$user_id = $request->get('user_id');	
		$get_user = User::find($user_id);
		
		if (!Hash::check($request->old_password, $get_user->password))
		{
			return response()->json(['success' => false, 'message' => 'The old password does not match our records.']);
		}
		//$user = User::find($email);
		$get_user->password = Hash::make($request->new_password);
		$get_user->save();
		
		return response()->json(['message' => 'Password change Successfully'], 200);
	}
	
	public function editProfile(Request $request)
    {
		$user_id = $request->get('user_id');
		
		$validator = Validator::make($request->all(), [
            'name' => 'required',
			'email' => "required|email|unique:users,email,$user_id,id",
			'mobile_no' => "required|unique:users,mobile_no,$user_id,id",
			'whatsapp_no' => 'required',
			'profile_image' => 'required',
			'address' => 'required',
        ]);
		
        if ($validator->fails())
		{
            $messages = $validator->errors()->messages();
			
			foreach ($messages as $key => $value)
			{
				$error[] = $value[0];
			}
			
            return response()->json($error, 406);
        }
		else
		{
			$user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
			$user->mobile_no = $request->mobile_no;
			$user->whatsapp_no = $request->whatsapp_no;
			$user->address = $request->address;
			$profile_image = $request->profile_image;
		
			if ($request->hasFile('profile_image'))
			{
				$profile_image = Str::uuid() . '.' . $request->profile_image->getClientOriginalExtension();
				
				$request->profile_image->storeAs('public/profile_image/', $profile_image);
				
				$profile_image = asset('storage/profile_image/' . $profile_image);
			}
			$user->profile_image = $profile_image;
            $user->save();
			
			$get_user = User::find($user_id);
			
			return response()->json(['message' => 'Profile Update Successfully', 'data' => $get_user], 200);
		}
    }
	
	public function getUserDetails(Request $request)
    {
		$user_id = $request->get('user_id');
		$get_user = User::where('id', $user_id)->first();
			
		return response()->json(['message' => 'Get Profile User Details Successfully', 'data' => $get_user], 200);
	}
    
}
