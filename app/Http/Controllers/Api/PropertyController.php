<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\Amenities;

class PropertyController extends Controller
{
	public function getProperty(Request $request)
    {
		$limit = 10;
		$offset = $request->page;
		$offset = ($offset - 1) * $limit;
		
		$get_properties = Property::where('status', "1")->orderBy('id', 'desc')->limit($limit)->offset($offset)->get();
		
		$data['per_page'] = $limit;
		$data['total_records'] = Property::where('status', "1")->count();
		$data['property_lists'] = $get_properties;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
    public function addProperty(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'project_name' => 'required',
            'property_for_id' => 'required',
            'property_type_id' => 'required',
            'location' => 'required',
            'locality' => 'required',
            'available_from_id' => 'required',
            'furnishing_status_id' => 'required',
            'age_of_property_id' => 'required',
            'property_view_id' => 'required',
            'bachelors_allowed' => 'required',
            'no_of_bedrooms' => 'required',
            'no_of_bathrooms' => 'required',
            'no_of_parking' => 'required',
            'plot_area' => 'required',
            'super_built_up_area' => 'required',
            'carpet_area' => 'required',
            'price_in_inr' => 'required',
            'maintenance' => 'required',
            'price_type_id' => 'required',
            'security_deposit_id' => 'required',
            'amenity_id' => 'required',
            'property_image' => 'required',
            'project_description' => 'required',
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
			$property = new Property();
			$property->project_name = $request->project_name;
			$property->project_description = $request->project_description;
			$property->property_for_id = $request->property_for_id;
			$property->property_type_id = $request->property_type_id;
			$property->location = $request->location;
			$property->locality = $request->locality;
			$property->available_from_id = $request->available_from_id;
			$property->furnishing_status_id = $request->furnishing_status_id;
			$property->age_of_property_id = $request->age_of_property_id;
			$property->property_view_id = $request->property_view_id;
			$property->bachelors_allowed = $request->bachelors_allowed;
			$property->no_of_bedrooms = $request->no_of_bedrooms;
			$property->no_of_bathrooms = $request->no_of_bathrooms;
			$property->no_of_parking = $request->no_of_parking;
			$property->measurement_id = $request->measurement_id;
			$property->plot_area = $request->plot_area;
			$property->super_built_up_area = $request->super_built_up_area;
			$property->carpet_area = $request->carpet_area;
			$property->price_in_inr = $request->price_in_inr;
			$property->maintenance = $request->maintenance;
			$property->price_type_id = $request->price_type_id;
			$property->security_deposit_id = $request->security_deposit_id;
			$property->amenity_id = $request->amenity_id;
			$property->user_id = $request->get('user_id');	
			$property->save();
			
			$property_id = $property->id;
			
			if ($request->hasFile('property_image'))
			{
				foreach ($request['property_image'] as $image)
				{
					$property_image = \Str::uuid() . '.' . $image->getClientOriginalExtension();
					$image->storeAs('public/property_image/', $property_image);
					$data['property_image'] = asset('storage/property_image/' . $property_image);
					
					$property_image = new PropertyImages();
					$property_image->property_id = $property_id;
					$property_image->image_path = $data['property_image'];
					$property_image->save();
				}
			}
			
			$get_property = Property::find($property_id);
			
			return response()->json(['message' => 'Property Create Successfully', 'data' => $get_property], 200);
			
		}	
	}
	
	public function update(Request $request)
    {
		$property_id = $request->get('property_id');
		
        $validator = Validator::make($request->all(), [
			'project_name' => 'required',
            'property_for_id' => 'required',
            'property_type_id' => 'required',
            'location' => 'required',
            'locality' => 'required',
            'available_from_id' => 'required',
            'furnishing_status_id' => 'required',
            'age_of_property_id' => 'required',
            'property_view_id' => 'required',
            'bachelors_allowed' => 'required',
            'no_of_bedrooms' => 'required',
            'no_of_bathrooms' => 'required',
            'no_of_parking' => 'required',
            'plot_area' => 'required',
            'super_built_up_area' => 'required',
            'carpet_area' => 'required',
            'price_in_inr' => 'required',
            'maintenance' => 'required',
            'price_type_id' => 'required',
            'security_deposit_id' => 'required',
            'amenity_id' => 'required',
            'property_image' => 'required',
            'project_description' => 'required',
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
			$property = Property::find($property_id);
			$property->project_name = $request->project_name;
			$property->project_description = $request->project_description;
			$property->property_for_id = $request->property_for_id;
			$property->property_type_id = $request->property_type_id;
			$property->location = $request->location;
			$property->locality = $request->locality;
			$property->available_from_id = $request->available_from_id;
			$property->furnishing_status_id = $request->furnishing_status_id;
			$property->age_of_property_id = $request->age_of_property_id;
			$property->property_view_id = $request->property_view_id;
			$property->bachelors_allowed = $request->bachelors_allowed;
			$property->no_of_bedrooms = $request->no_of_bedrooms;
			$property->no_of_bathrooms = $request->no_of_bathrooms;
			$property->no_of_parking = $request->no_of_parking;
			$property->measurement_id = $request->measurement_id;
			$property->plot_area = $request->plot_area;
			$property->super_built_up_area = $request->super_built_up_area;
			$property->carpet_area = $request->carpet_area;
			$property->price_in_inr = $request->price_in_inr;
			$property->maintenance = $request->maintenance;
			$property->price_type_id = $request->price_type_id;
			$property->security_deposit_id = $request->security_deposit_id;
			$property->amenity_id = $request->amenity_id;
			$property->save();
			
			if ($request->hasFile('property_image'))
			{
				foreach ($request['property_image'] as $image)
				{
					$property_image = \Str::uuid() . '.' . $image->getClientOriginalExtension();
					$image->storeAs('public/property_image/', $property_image);
					$data['property_image'] = asset('storage/property_image/' . $property_image);
					
					$property_image = new PropertyImages();
					$property_image->property_id = $property_id;
					$property_image->image_path = $data['property_image'];
					$property_image->save();
				}
			}
			
			$get_property = Property::find($property_id);
			
			return response()->json(['message' => 'Property Updated Successfully', 'data' => $get_property], 200);
		}  
    }
	
	function deleteProperty(Request $request)
	{
		$property_id = $request->get('property_id');
		
		$Property = Property::find($property_id);

		if($Property)
		{
			$Property->delete();
			$property_images = PropertyImages::where('property_id',$property_id)->first();
			if($property_images)
			{
				$property_images->delete();
			}
			return response()->json(['message' => 'Property removed successfully'], 200);
		}
		else
		{
			return response()->json(['message' => 'We cant find a user with that id!'], 406);
		}
	}
	
	//property-view
	public function propertyView(Request $request)
	{	
		$property_id = $request->get('property_id');
		
		$get_property_details = Property::select('properties.*','property_fors.property_for','property_types.title as property_type','available_froms.title as available_froms','furnishing_statuses.title as furnishing_status','age_of_properties.title as age_of_property','property_views.title as property_view','measurements.title as measurement','price_types.title as price_type','security_deposits.title as security_deposit')
		->join('property_fors', 'property_fors.id', '=', 'properties.property_for_id')
		->join('property_types', 'property_types.id', '=', 'properties.property_type_id')
		->join('available_froms', 'available_froms.id', '=', 'properties.available_from_id')
		->join('furnishing_statuses', 'furnishing_statuses.id', '=', 'properties.furnishing_status_id')
		->join('age_of_properties', 'age_of_properties.id', '=', 'properties.age_of_property_id')
		->join('property_views', 'property_views.id', '=', 'properties.property_view_id')
		->join('measurements', 'measurements.id', '=', 'properties.measurement_id')
		->join('price_types', 'price_types.id', '=', 'properties.price_type_id')
		->join('security_deposits', 'security_deposits.id', '=', 'properties.security_deposit_id')
		->where(['properties.id' => $property_id])->first();
		 
 		$get_property_images = PropertyImages::where('property_id',$property_id)->get();
		$amenitie_ids = explode(",",$get_property_details->amenity_id);
		
		$get_property_amenities = Amenities::whereIn('id',$amenitie_ids)->get()->toArray();
		$property_amenitie_title = implode(",",array_column($get_property_amenities, 'title'));
		$get_property_details['amenities'] = $property_amenitie_title;
		
		$data['get_property_details'] = $get_property_details;
		$data['get_property_images'] = $get_property_images;
		
		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getUserByProperty(Request $request)
    {
		$id = $request->get('id');
		$get_user = Property::where('user_id', $id)->get();
			
		return response()->json(['message' => 'Get User Property Successfully', 'data' => $get_user], 200);
	}
	
}
