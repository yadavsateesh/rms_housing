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
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
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
						<h4 class="card-title">Change Password</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('admin.change.password.update') }}" method="POST">
						@csrf
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-12 mb-2">
											<div class="form-group">
												<label class="text-label">Password <span class="text-red">*</span></label>
												<input type="password" class="form-control" name="password">
												@if ($errors->has('password'))
												<span class="validation" style="color:red;">
													{{ $errors->first('password') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-12 mb-2">
											<div class="form-group">
												<label class="text-label">Confirm Password <span class="text-red">*</span></label>
												<input type="password" class="form-control" name="confirm_password">
												@if ($errors->has('confirm_password'))
												<span class="validation" style="color:red;">
													{{ $errors->first('confirm_password') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<a href="{{ route('admin.change.password') }}" class="btn btn-light">Cancel</a>
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


