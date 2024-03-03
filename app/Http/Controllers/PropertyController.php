<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Property;
use App\Models\AgeOfProperty;
use App\Models\Amenities;
use App\Models\AvailableFrom;
use App\Models\BuildingType;
use App\Models\FurnishingStatus;
use App\Models\Measurement;
use App\Models\PriceType;
use App\Models\PropertyFor;
use App\Models\PropertyType;
use App\Models\PropertyView;
use App\Models\SecurityDeposit;
use App\Models\PropertyImages;
use DataTables;
use Str;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.property.list');
    }
	
	public function propertyList()
    {
        $get_properties = Property::get();
		
        return datatables()->of($get_properties)
			->addIndexColumn()
			->addColumn('action', function($data){
				
				$verification = ($data->is_verified == 1) ? '<a href="' . route('property.property-verification',[$data->id,'no_verified']) . '" class="icon__2" onclick="return confirm("Are you sure you want to unverified this property ?");"><i class="fas fa-ban"></i></a>' : '<a href="' . route('property.property-verification',[$data->id,'verified']) . '" class="verified" onclick="return confirm("Are you sure you want to verified this property ?");"><i class="fas fa-badge-check"></i></a>';
				
				return '
				<a href="' . route('property.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('property.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>
				<a href="' . route('property.show',$data->id) . '" class="icon__3"><i class="fa fa-eye"></i></a>
				'.$verification;
			})
			->editColumn('is_verified', function($data){
				return $data->is_verified == 1 ? '<span class="badge light badge-success">Verified</span>' : '<span class="badge light badge-danger">Not Verified</span>';
			})
			->editColumn('created_at', function($data){
				return date('Y-m-d H:i:s', strtotime($data->created_at));
			})
			->rawColumns(['is_verified', 'action'])
			->make(true);
	}
	
	public function create()
    {
		$get_property_for = PropertyFor::where('status', '1')->get();
		$get_property_type = PropertyType::where('status', '1')->get();
		$get_available_from = AvailableFrom::where('status', '1')->get();
		$get_furnishing_status = FurnishingStatus::where('status', '1')->get();
		$get_age_of_property = AgeOfProperty::where('status', '1')->get();
		$get_property_view = PropertyView::where('status', '1')->get();
		$get_measurement = Measurement::where('status', '1')->get();
		$get_price_type = PriceType::where('status', '1')->get();
		$get_security_deposit = SecurityDeposit::where('status', '1')->get();
		$get_amenities = Amenities::where('status', '1')->get();
		
		return view('admin.property.create', compact('get_property_for', 'get_property_type', 'get_available_from', 'get_furnishing_status', 'get_age_of_property', 'get_property_view', 'get_measurement', 'get_price_type', 'get_security_deposit', 'get_amenities'));
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
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

		$property = new Property();
		$property->user_id = $request->user_id;
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
		$property->amenity_id = implode(",",$request->amenity_id);
		$property->save();
		
		$property_id = $property->id;
		
		if ($request->hasFile('property_image'))
		{
			foreach ($request['property_image'] as $image)
			{
				$property_image = Str::uuid() . '.' . $image->getClientOriginalExtension();
				$image->storeAs('public/property_image/', $property_image);
				$data['property_image'] = asset('storage/property_image/' . $property_image);
				
				$property_image = new PropertyImages();
				$property_image->property_id = $property_id;
				$property_image->image_path = $data['property_image'];
				$property_image->save();
			}
		}
		
		return redirect()->route('property.index')->with('success', 'Property added successfully.');
    }
	
	public function edit(Property $property)
    {
		$get_property_for = PropertyFor::where('status', '1')->get();
		$get_property_type = PropertyType::where('status', '1')->get();
		$get_available_from = AvailableFrom::where('status', '1')->get();
		$get_furnishing_status = FurnishingStatus::where('status', '1')->get();
		$get_age_of_property = AgeOfProperty::where('status', '1')->get();
		$get_property_view = PropertyView::where('status', '1')->get();
		$get_measurement = Measurement::where('status', '1')->get();
		$get_price_type = PriceType::where('status', '1')->get();
		$get_security_deposit = SecurityDeposit::where('status', '1')->get();
		$get_amenities = Amenities::where('status', '1')->get();
		
        return view('admin.property.edit', compact('property', 'get_property_for', 'get_property_type', 'get_available_from', 'get_furnishing_status', 'get_age_of_property', 'get_property_view', 'get_measurement', 'get_price_type', 'get_security_deposit', 'get_amenities'));
    }
	
	public function update(Request $request, Property $property)
    {
        $data = $request->validate([
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
            'project_description' => 'required',
            'status' => 'required',
            'is_verified' => 'required',
        ]);
		
        $property = Property::find($property->id);
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
		$property->amenity_id = implode(",",$request->amenity_id);
		$property->status = $request->status;
		$property->is_verified = $request->is_verified;
		$property->save();
		$property_id = $property->id;
		
		if ($request->hasFile('property_image'))
		{
			foreach ($request['property_image'] as $image)
			{
				$property_image = Str::uuid() . '.' . $image->getClientOriginalExtension();
				$image->storeAs('public/property_image/', $property_image);
				$data['property_image'] = asset('storage/property_image/' . $property_image);
				
				$property_image = new PropertyImages();
				$property_image->property_id = $property_id;
				$property_image->image_path = $data['property_image'];
				$property_image->save();
			}
		}
		
		return redirect()->route('property.index')->with('success', 'Property type updated successfully.');
    }
	
	public function delete($id)
	{
		$property = Property::find($id);
		$property->delete();
		
		$property_images = PropertyImages::where('property_id',$id)->delete();
		
		return redirect()->route('property.index')->with('success', 'Property deleted successfully.');
		
	}
	
	public function show($property_id)
	{
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

		return view('admin.property.view', compact('get_property_details','get_property_images'));
	}
	
	public function propertyImagedelete($id)
	{
		$property = PropertyImages::find($id);
		$property->delete();
		return redirect()->route('property.show',$property->property_id)->with('success', 'Property image deleted successfully.');
	}
	
	public function propertyVerification($id,$status)
	{
		$property = Property::find($id);
		
		if($status == 'verified')
		{
			$property->is_verified = '1';
			$property->save();
		}
		else
		{
			$property->is_verified = '0';
			$property->save();
		}
		
		return redirect()->route('property.index')->with('success', 'Property updated successfully.');
	}
}
