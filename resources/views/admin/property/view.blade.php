@extends('admin.layouts.main')

@section('title') {{ 'RMS Housnig | '.env('APP_NAME') }} @endsection

@push('after-css')
<style>
	.label-title{
	font-weight: bold;
	}
</style>
@endpush

@section('content')
<div class="content-body">
	<div class="container-fluid">
		<div class="page-titles">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Property Details</a></li>
			</ol>
		</div>
		@if (Session::get('success'))
		<div class="alert alert-success alert-dismissible fade show">
			<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>	
			<strong>Success!</strong> {{ Session::get('success') }}
			<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
			</button>
		</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-8">
								<h4 class="card-title">Property View</h4>
							</div>
						</div>
					</div>
					
					<div class="card m-2">
						<div class="card-header">
							<h5 class="card-title">Property Basic Details</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 m-2">
									<div class="form-group">
										<label class="label-title"> Project Name:</label>
										<span>{{ $get_property_details->project_name }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Property For:</label>
										<span>{{ $get_property_details->property_for }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Property Type:</label>
										<span>{{ $get_property_details->property_type }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Location:</label>
										<span>{{ $get_property_details->location }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Locality:</label>
										<span>{{ $get_property_details->locality }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Available From:</label>
										<span>{{ $get_property_details->available_froms }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Furnishing Status:</label>
										<span>{{ $get_property_details->furnishing_status }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Age Of Property:</label>
										<span>{{ $get_property_details->age_of_property }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Number of Bedrooms:</label>
										<span>{{ $get_property_details->no_of_bedrooms }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Number of Bathrooms:</label>
										<span>{{ $get_property_details->no_of_bathrooms }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Number of Parking:</label>
										<span>{{ $get_property_details->no_of_parking }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Property View:</label>
										<span>{{ $get_property_details->property_view }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Bachelors Allowed:</label>
										<span>{{ $get_property_details->bachelors_allowed }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card m-2">
						<div class="card-header">
							<h5 class="card-title">Property Area Details</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 m-2">
									<div class="form-group">
										<label class="label-title"> Measurement:</label>
										<span>{{ $get_property_details->measurement }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Plot Area:</label>
										<span>{{ $get_property_details->plot_area }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Super built up area:</label>
										<span>{{ $get_property_details->super_built_up_area }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Carpet area:</label>
										<span>{{ $get_property_details->carpet_area }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card m-2">
						<div class="card-header">
							<h5 class="card-title">Property Price And Others Details</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 m-2">
									<div class="form-group">
										<label class="label-title"> Price In INR:</label>
										<span>{{ $get_property_details->price_in_inr }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Price Type:</label>
										<span>{{ $get_property_details->price_type }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Security Deposit:</label>
										<span>{{ $get_property_details->security_deposit }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Maintenance (Monthly):</label>
										<span>{{ $get_property_details->maintenance }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Status:</label>
										<span>{{ $get_property_details->status }}</label>
									</div>
									<div class="form-group">
										<label class="label-title"> Project/Building Description:</label>
										<p>{{ $get_property_details->project_description }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card m-2">
						<div class="card-header">
							<h5 class="card-title">Property Images</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 m-2">
									<div class="table-responsive">
										<table class="table table-striped table-bordered text-nowrap" style="border-top: 1px solid rgba(0, 40, 100, 0.12);">
											<thead>
												<tr>
													<th class="wd-15p border-bottom-0" product="text-align: center" style="    font-size: 15px;">Property Image</th>
													<th class="wd-15p border-bottom-0" product="text-align: center" style="    font-size: 15px;">Action</th>
													
												</tr>
											</thead>
											<tbody class="row_drag">
												@foreach($get_property_images as $image)
												<tr>
													<td>
														<a href="{{ $image->image_path }}" data-lightbox="category_desktop_banner">
														
														<img src="{{ $image->image_path }}" style="width:30%;height:20%;">
														</a>
													</td>	
													<td>	
														<button class="clo btn0"><a href="{{ route('property.property-image-delete',$image->id) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></button>
													</td>	
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-js')

@endpush
