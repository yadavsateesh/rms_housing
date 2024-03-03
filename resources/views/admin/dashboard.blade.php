@extends('admin.layouts.main')

@section('title') {{ 'RMS Housnig | '.env('APP_NAME') }} @endsection

@push('after-css')

@endpush

@section('content')
<div class="head-banner">
	<ul class="breadcrumb">
		<li>
			<a href="{{ route('dashboard') }}">Dashboard</a>
		</li>
	</ul>
</div>
<div class="dash_card">
	<div class="row">
		<div class="col-lg-3 col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3>{{ $total_users }}</h3>
					<p>Numbers of Users</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3>{{ $total_properties }}</h3>
					<p>Numbers of Property</p>
				</div>
				<div class="icon">
					<i class="fas fa-home"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3>{{ $total_verified_properties }}</h3>
					<p>Numbers of Verified Property</p>
				</div>
				<div class="icon">
					<i class="fas fa-home"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
			</div>
		</div>
		<div class="col-lg-3 col-4">
			<div class="small-box bg-danger">
				<div class="inner">
					<h3>{{$total_visitor}}</h3>
					<p>Numbers of Visttor</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
			</div>
		</div>
		<div class="col-lg-3 col-4">
			<div class="small-box bg-yellow ">
				<div class="inner">
					<h3>{{ $get_agent }}</h3>
					<p>Numbers of Agent</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3>{{ $get_visttor}}</h3>
					<p>User with logged</p>
				</div>
				<div class="icon">
					<i class="fas fa-users"></i>
				</div>
				<a href="#" class="small-box-footer"></a>
				</div>
		</div>
	</div>
</div>
@endsection

@push('after-js')

@endpush


