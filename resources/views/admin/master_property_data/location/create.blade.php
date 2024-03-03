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
				<li class="breadcrumb-item"><a href="{{ route('location.index') }}">Location List</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Location</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Location</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('location.store') }}" method="POST">
						@csrf
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Location Title <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="title" value="{{ old('title') }}">
												@if ($errors->has('title'))
												<span class="validation" style="color:red;">
													{{ $errors->first('title') }}
												</span>
												@endif
											</div>
										</div>
									</div>
								<a href="{{ route('location.index') }}" class="btn btn-light">Cancel</a>
								<button type="submit" class="btn mr-2 btn-dark">Submit</button>
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
