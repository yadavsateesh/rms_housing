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
				<li class="breadcrumb-item"><a href="{{ route('property-for.index') }}">Property For List</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Property For</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Property For</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('property-for.store') }}" method="POST">
						@csrf
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Property For <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="property_for" value="{{ old('property_for') }}">
												@if ($errors->has('property_for'))
												<span class="validation" style="color:red;">
													{{ $errors->first('property_for') }}
												</span>
												@endif
											</div>
										</div>
									</div>
								<a href="{{ route('property-for.index') }}" class="btn btn-light">Cancel</a>
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
