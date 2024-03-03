@extends('admin.layouts.main')

@section('title') {{ 'RMS Housnig | '.env('APP_NAME') }} @endsection

@push('after-css')

@endpush

@section('content')
<div class="content-body">
	<div class="container-fluid">
		<div class="page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ route('property.index') }}">Property List</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Property</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit Property</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('property.update',$property->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-12 mb-2">
											<div class="form-group">
												<label class="text-label">Project Name <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="project_name" value="{{ $property->project_name }}">
												@if ($errors->has('project_name'))
												<span class="validation" style="color:red;">
													{{ $errors->first('project_name') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-12 mb-2">
											<div class="form-group">
												<label class="text-label">Project/Building Description <span class="text-red">*</span></label>
												<textarea type="text" class="form-control" name="project_description" value="{{ $property->project_description }}" id="project_description">{{ $property->project_description }}</textarea>
												@if ($errors->has('project_description'))
												<span class="validation" style="color:red;">
													{{ $errors->first('project_description') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Location <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="location" value="{{ $property->location }}">
												@if ($errors->has('location'))
												<span class="validation" style="color:red;">
													{{ $errors->first('location') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Locality <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="locality" value="{{ $property->locality }}">
												@if ($errors->has('locality'))
												<span class="validation" style="color:red;">
													{{ $errors->first('locality') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">For <span class="text-red">*</span></label>
												<select class="form-control" name="property_for_id" data-id="{{ old('property_for_id') }}">
													<option value="">-- Select Property For --</option>
													@foreach ($get_property_for as $property_for)
														<option value="{{ $property_for->id }}" @if($property->property_for_id == $property_for->id ) selected="selected" @endif>{{ $property_for->property_for }}</option>
													@endforeach
												</select>
												@if ($errors->has('property_for_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('property_for_id') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Property Type <span class="text-red">*</span></label>
												<select class="form-control" name="property_type_id" data-id="{{ old('property_type_id') }}">
													<option value="">-- Select Property Type --</option>
													@foreach ($get_property_type as $property_type)
														<option value="{{ $property_type->id }}" @if($property->property_type_id == $property_type->id ) selected="selected" @endif>{{ $property_type->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('property_type_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('property_type_id') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Available From <span class="text-red">*</span></label>
												<select class="form-control" name="available_from_id" data-id="{{ old('available_from_id') }}">
													<option value="">-- Select Available From --</option>
													@foreach ($get_available_from as $available_from)
														<option value="{{ $available_from->id }}" @if($property->available_from_id == $available_from->id ) selected="selected" @endif>{{ $available_from->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('available_from_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('available_from_id') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Furnishing Status <span class="text-red">*</span></label>
												<select class="form-control" name="furnishing_status_id" data-id="{{ old('furnishing_status_id') }}">
													<option value="">-- Select Furnishing Status --</option>
													@foreach ($get_furnishing_status as $furnishing_status)
														<option value="{{ $furnishing_status->id }}" @if($property->furnishing_status_id == $furnishing_status->id ) selected="selected" @endif>{{ $furnishing_status->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('furnishing_status_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('furnishing_status_id') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Age Of Property<span class="text-red">*</span></label>
												<select class="form-control" name="age_of_property_id">
													<option value="">-- Select Age Of Property --</option>
													@foreach ($get_age_of_property as $age_of_property)
														<option value="{{ $age_of_property->id }}" @if($property->age_of_property_id == $age_of_property->id ) selected="selected" @endif>{{ $age_of_property->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('age_of_property_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('age_of_property_id') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Property View <span class="text-red">*</span></label>
												<select class="form-control" name="property_view_id" data-id="{{ old('property_view_id') }}">
													<option value="">-- Select Property View --</option>
													@foreach ($get_property_view as $property_view)
														<option value="{{ $property_view->id }}" @if($property->property_view_id == $property_view->id ) selected="selected" @endif>{{ $property_view->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('property_view_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('property_view_id') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Bachelors Allowed <span class="text-red">*</span></label>
												<select class="form-control" name="bachelors_allowed" data-id="{{ old('bachelors_allowed') }}">
													<option value="yes" @if($property->bachelors_allowed == "yes" ) selected="selected" @endif>Yes</option>
													<option value="no" @if($property->bachelors_allowed == "no" ) selected="selected" @endif>No</option>
													
												</select>
												@if ($errors->has('bachelors_allowed'))
												<span class="validation" style="color:red;">
													{{ $errors->first(bachelors_allowed) }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">No Of Bedrooms <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="no_of_bedrooms" value="{{ $property->no_of_bedrooms }}">
												@if ($errors->has('no_of_bedrooms'))
												<span class="validation" style="color:red;">
													{{ $errors->first('no_of_bedrooms') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">No Of Bathrooms <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="no_of_bathrooms" value="{{ $property->no_of_bathrooms }}">
												@if ($errors->has('no_of_bathrooms'))
												<span class="validation" style="color:red;">
													{{ $errors->first('no_of_bathrooms') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">No Of Parking <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="no_of_parking" value="{{ $property->no_of_parking }}">
												@if ($errors->has('no_of_parking'))
												<span class="validation" style="color:red;">
													{{ $errors->first('no_of_parking') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Measurement <span class="text-red">*</span></label>
												<select class="form-control" name="measurement_id">
													<option value="">-- Select Measurement --</option>
													@foreach ($get_measurement as $measurement)
														<option value="{{ $measurement->id }}" @if($property->measurement_id == $measurement->id ) selected="selected" @endif>{{ $measurement->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('measurement_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first(measurement_id) }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Plot Area <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="plot_area" value="{{ $property->plot_area }}">
												@if ($errors->has('plot_area'))
												<span class="validation" style="color:red;">
													{{ $errors->first('plot_area') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Super Built Up Area <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="super_built_up_area" value="{{ $property->super_built_up_area }}">
												@if ($errors->has('super_built_up_area'))
												<span class="validation" style="color:red;">
													{{ $errors->first('super_built_up_area') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Carpet Area <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="carpet_area" value="{{ $property->carpet_area }}">
												@if ($errors->has('carpet_area'))
												<span class="validation" style="color:red;">
													{{ $errors->first('carpet_area') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Price In INR <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="price_in_inr" value="{{ $property->price_in_inr }}">
												@if ($errors->has('price_in_inr'))
												<span class="validation" style="color:red;">
													{{ $errors->first('price_in_inr') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Maintenance <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="maintenance" value="{{ $property->maintenance }}">
												@if ($errors->has('maintenance'))
												<span class="validation" style="color:red;">
													{{ $errors->first('maintenance') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Price Type<span class="text-red">*</span></label>
												<select class="form-control" name="price_type_id" data-id="{{ old('price_type_id') }}">
													<option value="">-- Select Price Type --</option>
													@foreach ($get_price_type as $price_type)
														<option value="{{ $price_type->id }}" @if($property->price_type_id == $price_type->id ) selected="selected" @endif>{{ $price_type->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('price_type_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('price_type_id') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Security Deposit <span class="text-red">*</span></label>
												<select class="form-control" name="security_deposit_id" data-id="{{ old('security_deposit_id') }}">
													<option value="">-- Select Security Deposit --</option>
													@foreach ($get_security_deposit as $security_deposit)
														<option value="{{ $security_deposit->id }}" @if($property->security_deposit_id == $security_deposit->id ) selected="selected" @endif>{{ $security_deposit->title }}</option>
													@endforeach
												</select>
												@if ($errors->has('security_deposit_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('security_deposit_id') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Amenities<span class="text-red">*</span></label>
												@foreach ($get_amenities as $amenities)
												<div class="form-check">
												  <input class="form-check-input" type="checkbox" value="{{ $amenities->id }}" id="amenity_id{{ $amenities->id }}" name="amenity_id[]" @if(in_array($amenities->id, explode(",",$property->amenity_id))) checked="checked"  @endif>
												  <label class="form-check-label" for="amenity_id{{ $amenities->id }}">
													{{ $amenities->title }}
												  </label>
												</div>
												@endforeach
												@if ($errors->has('amenity_id'))
												<span class="validation" style="color:red;">
													{{ $errors->first('amenity_id') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Property Image </label>
												<input type="file" class="form-control" name="property_image[]" value="{{ old('property_image') }}" multiple>
												@if ($errors->has('property_image'))
												<span class="validation" style="color:red;">
													{{ $errors->first('property_image') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label>Status <span class="text-red">*</span></label>
												<select class="form-control" name="status" id="status">
													<option value="">-- Select Status --</option>
													<option value="1" @if($property->status == 1) selected="selected" @endif >Active</option>
													<option value="0" @if($property->status == 0) selected="selected" @endif >Inactive</option>
												</select>
												@if ($errors->has('status'))
												<span class="validation" style="color:red;">
													{{ $errors->first('status') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label>Is Verified <span class="text-red">*</span></label>
												<select class="form-control" name="is_verified" id="is_verified">
													<option value="">-- Select --</option>
													<option value="1" @if($property->is_verified == 1) selected="selected" @endif >Verified</option>
													<option value="0" @if($property->is_verified == 0) selected="selected" @endif >Not Verified</option>
												</select>
												@if ($errors->has('is_verified'))
												<span class="validation" style="color:red;">
													{{ $errors->first('is_verified') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<a href="{{ route('property.index') }}" class="btn btn-light">Cancel</a>
									<button type="submit" class="btn mr-2 btn-dark">Update</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>      
@endsection

@push('after-js')
<script>
ClassicEditor.create( document.querySelector( '#project_description' ) )
	.then( editor => {
			console.log( editor );
	})
	.catch( error => {
			console.error( error );
	});
</script>
@endpush
