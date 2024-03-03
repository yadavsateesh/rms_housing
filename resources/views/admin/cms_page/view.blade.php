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
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Cms Page Details</a></li>
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
								<h4 class="card-title">Cms Page Details</h4>
							</div>
						</div>
					</div>
					<div class="card m-2">
						<div class="card-header">
							<h5 class="card-title">{{ $cmspage->title }}</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12 m-2">
									<div class="form-group">
										<span>{{ $cmspage->description }}</label>
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
