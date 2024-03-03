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
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Property For List</a></li>
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
							<h4 class="card-title">Property For List</h4>
							</div>
							<div class="col-lg-4">
								<a href="{{ route('property-for.create') }}" class="float-right">
									<span class="dt-button btn btn-primary large_button">Add Property For</span>
								</a>
							</div>
						</div>
						
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="property_for_lists" class="display min-w850">
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-js')
<script>
	$('#property_for_lists').DataTable({
		ajax: {
			url: "{{ route('property-for-list') }}",
			type: 'POST',
		},
		serverSide: true,
		bAutoWidth: false,
		order: [],
		columns: [
			{ data: 'id', title: 'ID' },
			{ data: 'property_for', title: 'Name' },
			{ data: 'status', title: 'Status' },
			{ data: 'created_at', title: 'Created At' },
			{ data: 'action', title: 'Action' },
		],
	});
	
	function confirm_click() {
		return confirm('Are you sure you want to delete?');
	}
</script>
@endpush
