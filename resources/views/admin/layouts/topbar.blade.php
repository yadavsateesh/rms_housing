<header class="page-header">
	<nav class="main-menu">
		<div class="logo">
			<h1><a href="{{ route('dashboard') }}">RMS<span></span></a></h1>
		</div>
		<!-- <a href="index.html"class="logo"><img src="image/logo.jpg" alt="img"></a> -->
		<ul class="menu main_drop">
            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
			</li>
			<li><a href="javascript:void(0)"><i class="fas fa-list"></i> <span>Master Property Data</span> <i class="fal fa-chevron-down"></i></a>
			   <ul class="drp-menu">
					<li><a href="{{ route('property-for.index') }}">Property For</a></li>
					<li><a href="{{ route('building-type.index') }}">Building Type</a></li>
					<li><a href="{{ route('property-type.index') }}">Property Type</a></li>
					<li><a href="{{ route('available-from.index') }}">Available From</a></li>
					<li><a href="{{ route('furnishing-status.index') }}">Furnishing Status</a></li>
					<li><a href="{{ route('age-of-property.index') }}">Age Of Property</a></li>
					<li><a href="{{ route('property-view.index') }}">Property View</a></li>
					<li><a href="{{ route('measurement.index') }}">Measurement</a></li>
					<li><a href="{{ route('price-type.index') }}">Price Type</a></li>
					<li><a href="{{ route('security-deposit.index') }}">Security Deposit</a></li>
					<li><a href="{{ route('amenities.index') }}">Amenities</a></li>
					<li><a href="{{ route('location.index') }}">Location</a></li>
			   </ul>
			</li>
			
			<li><a href="{{ route('property.index') }}"><i class="fas fa-home"></i> <span>Property</span></a>
			</li>
			<li><a href="{{ route('cmspage.index') }}"><i class="fas fa-file-alt"></i> <span>CMS Pages</span></a></li>
			
			<li><a href="javascript:void(0)"><i class="fas fa-user"></i> <span>Users</span> <i class="fal fa-chevron-down"></i></a>
				<ul class="drp-menu">
					 <a href="{{ route('user-list','visitor') }}"> <span>User with logged</span></a>
					 <a href="{{ route('user-list','agent') }}"> <span>Agent Users</span></a>
				</ul>
			</li>
		</ul>
	</nav>
</header>
<section class="mobile_manu">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-6">
				<div class="mobile_logo">
					<a href="{{ route('dashboard') }}"><img src="{{ asset('image/logo.jpg') }}"></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-6">
				<div class="admin-profile">
					<div class="login">
						<div class="dropdown1">
							<button id="myBtn1">
								<span class="greeting">{{ Auth::user()->name }}</span>
								<i class="dropbtn1 fas fa-user"></i>
							</button>
							<div id="myDropdown1" class="dropdown-content1">
								<a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i>Manage Profile</a>
								<i class="fas fa-lock"></i><a href="{{ route('admin.change.password') }}">Change Password</a>
								<a href="{{ route('logout') }}" onclick="event.preventDefault();    document.getElementById('logout-form').submit();">
                                 <i class="fas fa-lock"></i> {{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</div>
					</div>
					<div class="mobile-menu">
						<div id="mySidepanel" class="sidepanel">
							<div class="m_menu main-menu">
								<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="far fa-times"></i></a>
								<ul class="menu main_drop">
									<li><a href="{{ route('dashboard') }}"><span>Dashboard</span> <i class="fal fa-chevron-down"></i></a>
									</li>
									
									<li><a href="#"><i class="fas fa-tachometer-alt"></i> <span>Master Property Data</span> <i class="fal fa-chevron-down"></i></a>
									   <ul class="drp-menu">
										  <li><a href="{{ route('property-for.index') }}">Property For</a></li>
										  <li><a href="{{ route('building-type.index') }}">Building Type</a></li>
										  <li><a href="{{ route('property-type.index') }}">Property Type</a></li>
										  <li><a href="{{ route('available-from.index') }}">Available From</a></li>
										  <li><a href="{{ route('furnishing-status.index') }}">Furnishing Status</a></li>
										  <li><a href="{{ route('age-of-property.index') }}">Age Of Property</a></li>
										  <li><a href="{{ route('property-view.index') }}">Property View</a></li>
										  <li><a href="{{ route('measurement.index') }}">Measurement</a></li>
										  <li><a href="{{ route('price-type.index') }}">Price Type</a></li>
										  <li><a href="{{ route('security-deposit.index') }}">Security Deposit</a></li>
										  <li><a href="{{ route('amenities.index') }}">Amenities</a></li>
										  <li><a href="{{ route('location.index') }}">Location</a></li>
									   </ul>
									</li>
									<li><a href="{{ route('property.index') }}"><i class="fas fa-home"></i> <span>Property</span></a>
									</li>
									<li><a href="{{ route('cmspage.index') }}"><i class="fas fa-file-alt"></i> <span>CMS Pages</span></a></li>
									<li>
										<ul class="drp-menu">
											 <a href="{{ route('user-list','vistor') }}"><i class="fas fa-file-alt"></i> <span>Vistor Users</span></a>
											 <a href="{{ route('user-list','agent') }}"><i class="fas fa-file-alt"></i> <span>Agent Users</span></a>
										</ul>
									</li>
								</ul>                
							</div>
						</div>
						<button class="openbtn" onclick="openNav()"><i class="far fa-bars"></i></button> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>