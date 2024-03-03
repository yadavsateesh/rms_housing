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
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Profile</a></li>
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
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit Profile</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
							<div id="smartwizard" class="form-wizard  order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Name <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
												@if ($errors->has('name'))
												<span class="validation" style="color:red;">
													{{ $errors->first('name') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Email <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}">
												@if ($errors->has('email'))
												<span class="validation" style="color:red;">
													{{ $errors->first('email') }}
												</span>
												@endif
											</div>
										</div>
										<!--<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Mobile No </label>
												<input type="text" class="form-control" name="mobile_no" value="{{ auth()->user()->mobile_no }}">
												@if ($errors->has('mobile_no'))
												<span class="validation" style="color:red;">
													{{ $errors->first('mobile_no') }}
												</span>
												@endif
											</div>
										</div>-->
										<!--<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Whatsapp No </label>
												<input type="text" class="form-control" name="whatsapp_no" value="{{ auth()->user()->whatsapp_no }}">
												@if ($errors->has('whatsapp_no'))
												<span class="validation" style="color:red;">
													{{ $errors->first('whatsapp_no') }}
												</span>
												@endif
											</div>
										</div>-->
										<input type="hidden" name="old_profile_image" value="{{ auth()->user()->profile_image }}"/>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Profile Image </label>
												<input type="file" class="form-control" name="profile_image" value="{{ old('profile_image') }}">
												@if ($errors->has('profile_image'))
												<span class="validation" style="color:red;">
													{{ $errors->first('profile_image') }}
												</span>
												@endif
											</div>
											<img src="{{ $admin->profile_image }}" class="rounded" alt="..." height="100px" width="100px">
										</div>
									</div>
									<a href="{{ route('admin.profile') }}" class="btn btn-light">Cancel</a>
									<button type="submit" class="btn mr-2 btn-primary">Update</button>
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

@endpush


