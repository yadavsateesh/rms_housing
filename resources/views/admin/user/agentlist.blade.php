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
				<li class="breadcrumb-item active"><a href="javascript:void(0)">User List</a></li>
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
							<h4 class="card-title">User List</h4>
							</div>
						</div>
						
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="agent_user_list" class="display min-w850">
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
	$('#agent_user_list').DataTable({
		ajax: {
			url: "{{ route('agent-list') }}",
			type: 'POST',
		},
		serverSide: true,
		bAutoWidth: false,
		order: [],
		columns: [
			{ data: 'id', title: 'No' },
			{ data: 'name', title: 'Name' },
			{ data: 'email', title: 'Email' },
			{ data: 'mobile_no', title: 'Mobile' },
			{ data: 'is_block', title: 'Status' },
			{ data: 'created_at', title: 'Created At' },
			{ data: 'action', title: 'Action' },
		],
	});
	
	function confirm_click() {
		return confirm('Are you sure you want to delete?');
	}
</script>
@endpush
