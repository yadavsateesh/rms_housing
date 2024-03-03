<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'project_name',
		'project_description',
		'location',
		'locality',
		'property_for_id',
		'property_type_id',
		'building_type_id',
		'available_from_id',
		'furnishing_status_id',
		'age_of_property_id',
		'property_view_id',
		'measurement_id',
		'price_type_id',
		'security_deposit_id',
		'amenity_id',
		'no_of_bedrooms',
		'no_of_bathrooms',
		'no_of_parking',
		'bachelors_allowed',
		'plot_area',
		'super_built_up_area',
		'carpet_area',
		'price_in_inr',
		'maintenance',
		'status',
		'is_verified',
    ];
}
