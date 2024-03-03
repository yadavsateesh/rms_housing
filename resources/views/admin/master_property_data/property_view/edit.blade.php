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
				<li class="breadcrumb-item"><a href="{{ route('property-view.index') }}">Property View List</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Property View</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit Property View</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('property-view.update',$property_view->id) }}" method="POST">
							@csrf
							@method('PUT')
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Property View Title <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="title" value="{{ $property_view->title }}">
												@if ($errors->has('title'))
												<span class="validation" style="color:red;">
													{{ $errors->first('tilte') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label>Status <span class="text-red">*</span></label>
												<select class="form-control" name="status" id="status">
													<option value="">-- Select Status --</option>
													<option value="1" @if($property_view->status == 1) selected="selected" @endif >Active</option>
													<option value="0" @if($property_view->status == 0) selected="selected" @endif >Inactive</option>
												</select>
											</div>
										</div>
									</div>
									<a href="{{ route('property-view.index') }}" class="btn btn-light">Cancel</a>
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
@endpush
