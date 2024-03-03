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
				<li class="breadcrumb-item"><a href="{{ route('cmspage.index') }}">CMS Page List</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Edit CMS Page</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit CMS Page</h4>
					</div>
					<div class="card-body">
						<form role="form" action="{{ route('cmspage.update',$cmspage->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div id="smartwizard" class="form-wizard order-create">
								<div class="tab-content">
									<div class="row">
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label class="text-label">Title <span class="text-red">*</span></label>
												<input type="text" class="form-control" name="title" value="{{ $cmspage->title }}" readonly>
												@if ($errors->has('title'))
												<span class="validation" style="color:red;">
													{{ $errors->first('title') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-lg-6 mb-2">
											<div class="form-group">
												<label>Status <span class="text-red">*</span></label>
												<select class="form-control" name="status" id="status">
													<option value="">-- Select Status --</option>
													<option value="1" @if($cmspage->status == 1) selected="selected" @endif >Active</option>
													<option value="0" @if($cmspage->status == 0) selected="selected" @endif >Inactive</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="col-lg-12 mb-2">
											<div class="form-group">
												<label class="text-label">Project/Building Description <span class="text-red">*</span></label>
												<textarea type="text" class="form-control" name="description" id="description" value="{{ $cmspage->description }}">{{ $cmspage->description }}</textarea>
												@if ($errors->has('description'))
												<span class="validation" style="color:red;">
													{{ $errors->first('description') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<a href="{{ route('cmspage.index') }}" class="btn btn-light">Cancel</a>
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
ClassicEditor.create( document.querySelector( '#description' ) )
	.then( editor => {
			console.log( editor );
	})
	.catch( error => {
			console.error( error );
	});
</script>
@endpush
