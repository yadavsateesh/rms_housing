<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Location;

class MasterPropertyData extends Controller
{
    public function getPropertyfor(Request $request)
    {
		$get_property_for = PropertyFor::where('status', '1')->get();
		
		$data['total_records'] = PropertyFor::where('status', "1")->count();
		$data['get_property_for'] = $get_property_for;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getPropertytype(Request $request)
    {
		$get_property_type = PropertyType::where('status', '1')->get();
		
		$data['total_records'] = PropertyType::where('status', "1")->count();
		$data['get_property_type'] = $get_property_type;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getAvailablefrom(Request $request)
    {
		$get_available_from = AvailableFrom::where('status', '1')->get();
		
		$data['total_records'] = AvailableFrom::where('status', "1")->count();
		$data['get_available_from'] = $get_available_from;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getFurnishingstatus(Request $request)
    {
		$get_furnishing_status = FurnishingStatus::where('status', '1')->get();
		
		$data['total_records'] = FurnishingStatus::where('status', "1")->count();
		$data['get_furnishing_status'] = $get_furnishing_status;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getAgeofProperty(Request $request)
    {
		$get_age_of_property = AgeOfProperty::where('status', '1')->get();
		
		$data['total_records'] = AgeOfProperty::where('status', "1")->count();
		$data['get_age_of_property'] = $get_age_of_property;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getPropertyview(Request $request)
    {
		$get_property_view = PropertyView::where('status', '1')->get();
		
		$data['total_records'] = PropertyView::where('status', "1")->count();
		$data['get_property_view'] = $get_property_view;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getMeasurement(Request $request)
    {
		$get_measurement = Measurement::where('status', '1')->get();
		
		$data['total_records'] = Measurement::where('status', "1")->count();
		$data['get_measurement'] = $get_measurement;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getPricetype(Request $request)
    {
		$get_price_type = PriceType::where('status', '1')->get();
		
		$data['total_records'] = PriceType::where('status', "1")->count();
		$data['get_price_type'] = $get_price_type;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getSecuritydeposit(Request $request)
    {
		$get_security_deposit = SecurityDeposit::where('status', '1')->get();
		
		$data['total_records'] = SecurityDeposit::where('status', "1")->count();
		$data['get_security_deposit'] = $get_security_deposit;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getAmenities(Request $request)
    {
		$get_amenities = Amenities::where('status', '1')->get();
		
		$data['total_records'] = SecurityDeposit::where('status', "1")->count();
		$data['get_amenities'] = $get_amenities;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getBuildingtype(Request $request)
    {
		$get_building_type = BuildingType::where('status', '1')->get();
		
		$data['total_records'] = BuildingType::where('status', "1")->count();
		$data['get_building_type'] = $get_building_type;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
	
	public function getLocation(Request $request)
    {
		$get_location = Location::where('status', '1')->get();
		
		$data['total_records'] = Location::where('status', "1")->count();
		$data['get_location'] = $get_location;

		return response()->json(['message' => 'data found','data' => $data], 200);
	}
}
