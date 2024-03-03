<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title','RMS Housing')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
		<style type="text/css">
			.logo h1 {
			font-size: 35px;
			font-weight: 800;
			margin: 0;
			text-transform: uppercase;
			}
			.logo h1 a{
			color:#df453e;
			}
			.logo h1 a span{
			color:#1b3e41;
			}
			.logo h1 a:hover{
			text-decoration: none;
			}
		</style>
		@stack('after-css')
	</head>
	<body>
		<!--**********************************
			Main wrapper start
		***********************************-->
        @include('admin.layouts.topbar')
		<section class="page-content">
			<div class="search-and-user">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-6">
						<ul class="admin-menu">
							<li>
								<div class="switch">
									<label for="mode">
									</label>
								</div>
								<button class="collapse-btn" aria-expanded="true" aria-label="collapse menu">
									<i class="fas fa-bars"></i>
									<span>Collapse</span>
								</button>
							</li>
						</ul>
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
										<a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> Manage Profile</a>
										<a href="{{ route('admin.change.password') }}"><i class="fas fa-lock"></i>Change Password</a>
										<a href="{{ route('logout') }}" onclick="event.preventDefault();    document.getElementById('logout-form').submit();">
											<i class="fas fa-lock"></i> {{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@yield('admin.breadcrumbs')
			@yield('content')
		</section>
		<!--**********************************
			Main wrapper end
		***********************************-->
		
		<!--**********************************
			Scripts
		***********************************-->
		<!-- Required vendors -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
		<script type="text/javascript">
			$('.main-menu>ul>li>a, .main-menu ul.drp-menu>li>a').on('click', function(e) {
				var element = $(this).parent('li');
				if (element.hasClass('open')) {
					element.removeClass('open');
					element.find('li').removeClass('open');
					element.find('ul').slideUp(500,"swing");
				}
				else {
					element.addClass('open');
					element.children('ul').slideDown(800,"swing");
					element.siblings('li').children('ul').slideUp(800,"swing");
					element.siblings('li').removeClass('open');
					element.siblings('li').find('li').removeClass('open');
					element.siblings('li').find('ul').slideUp(1000,"swing");
				}
			});
			
			$('.dropdown1').click(function(){
				$('.dropdown-content1').toggle();
			});
			
			function openNav() {
				document.getElementById("mySidepanel").style.width = "100%";
			}
			function closeNav() {
				document.getElementById("mySidepanel").style.width = "0";
			}
			
		</script>
		<script type="text/javascript">
			const html = document.documentElement;
			const body = document.body;
			const menuLinks = document.querySelectorAll(".admin-menu a");
			const collapseBtn = document.querySelector(".admin-menu .collapse-btn");
			const toggleMobileMenu = document.querySelector(".toggle-mob-menu");
			const switchInput = document.querySelector(".switch input");
			const switchLabel = document.querySelector(".switch label");
			const switchLabelText = switchLabel.querySelector("span:last-child");
			const collapsedClass = "collapsed";
			const lightModeClass = "light-mode";
			
			collapseBtn.addEventListener("click", function () {
				body.classList.toggle(collapsedClass);
				this.getAttribute("aria-expanded") == "true"
				? this.setAttribute("aria-expanded", "false")
				: this.setAttribute("aria-expanded", "true");
				this.getAttribute("aria-label") == "collapse menu"
				? this.setAttribute("aria-label", "expand menu")
				: this.setAttribute("aria-label", "collapse menu");
			});
			
			toggleMobileMenu.addEventListener("click", function () {
				body.classList.toggle("mob-menu-opened");
				this.getAttribute("aria-expanded") == "true"
				? this.setAttribute("aria-expanded", "false")
				: this.setAttribute("aria-expanded", "true");
				this.getAttribute("aria-label") == "open menu"
				? this.setAttribute("aria-label", "close menu")
				: this.setAttribute("aria-label", "open menu");
			});
			
			for (const link of menuLinks) {
				link.addEventListener("mouseenter", function () {
					if (
					body.classList.contains(collapsedClass) &&
					window.matchMedia("(min-width: 768px)").matches
					) {
						const tooltip = this.querySelector("span").textContent;
						this.setAttribute("title", tooltip);
						} else {
						this.removeAttribute("title");
					}
				});
			}
			
			if (localStorage.getItem("dark-mode") === "false") {
				html.classList.add(lightModeClass);
				switchInput.checked = false;
				switchLabelText.textContent = "Light";
			}
			
			switchInput.addEventListener("input", function () {
				html.classList.toggle(lightModeClass);
				if (html.classList.contains(lightModeClass)) {
					switchLabelText.textContent = "Light";
					localStorage.setItem("dark-mode", "false");
					} else {
					switchLabelText.textContent = "Dark";
					localStorage.setItem("dark-mode", "true");
				}
			});
		</script>
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		@stack('after-js')
	</body>
</html>