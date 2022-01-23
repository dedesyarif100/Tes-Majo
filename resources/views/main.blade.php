
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">

	<style>
		#content {
			min-height: 100vh;
			margin-bottom: 3rem;
		}
		#footer {
			position:absolute;
			bottom:0;
			width:100%;
			height:60px;   /* Height of the footer
			background:#6cf; */
		}
	</style>
    @yield('css')
	<title>@yield('title')</title>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a class="logo text-white fw-bold">
					POS Mini
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fas fa-bars"></i>
					</span>
				</button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="fas fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ 'https://ui-avatars.com/api/?name='.Auth::user()->email }}" alt="Avatar" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->email }}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn btn-block" style="background-color: #f5f5f5">
                                                <i class="fas fa-power-off text-danger mr-2"></i> Logout
	    									</button>
                                        </form>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						{{-- <li class="nav-item" id="users">
							<a href="{{ route('user.index') }}">
								<i class="fas fa-user"></i>
								<p>User</p>
							</a>
						</li> --}}
                        <li class="nav-item" id="category-product">
							<a href="{{ route('category-product.index') }}">
								<i class="fas fa-user"></i>
								<p>Category Product</p>
							</a>
						</li>
                        <li class="nav-item" id="product">
							<a href="{{ route('product.index') }}">
								<i class="fas fa-user"></i>
								<p>Product</p>
							</a>
						</li>
						<li class="nav-item" id="customer">
							<a href="{{ route('customer.index') }}">
								<i class="fas fa-tag"></i>
								<p>Customers</p>
							</a>
						</li>
                        {{-- <li class="nav-item" id="supplier">
							<a href="{{ route('supplier.index') }}">
								<i class="fas fa-tag"></i>
								<p>Supplier</p>
							</a>
						</li> --}}
                        <li class="nav-item" id="supplier">
							<a href="{{ route('purchase-transaction.index') }}">
								<i class="fas fa-tag"></i>
								<p>Purchase Transaction</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		<div class="main-panel">
			<div id="content" style="margin-top: 5rem;">
				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
    @yield('modal')
	<!--   Core JS Files   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
    <script>
        let lists = document.querySelectorAll('ul.nav li.nav-item');
        lists.forEach(list => {
            // console.log(list.childNodes[0]);
            if (location.href == list.childNodes[1].href) {
                list.classList.add('active');
            }
            else {
                list.classList.remove('active');
            }
        });

        function toSnakeCase(str) {
            return str &&
            str
                .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                .map(x => x.toLowerCase())
                .join('_');
        }
    </script>
    @yield('js')
</body>
</html>
