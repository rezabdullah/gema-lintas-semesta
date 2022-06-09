<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GEMA LINTAS SEMESTA - {{ $title ?? 'Kargo Domestik dan Internasional' }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('bizland/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('bizland/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('bizland/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.7.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
	<section id="topbar" class="d-flex align-items-center">
		<div class="container d-flex justify-content-center justify-content-md-between">
		<div class="contact-info d-flex align-items-center">
			<i class="bi bi-envelope d-flex align-items-center"><a href="mailto:gema.express@yahoo.com">gema.express@yahoo.com</a></i>
			<i class="bi bi-phone d-flex align-items-center ms-4"><span>021 8378 3267</span></i>
		</div>
		<div class="social-links d-none d-md-flex align-items-center">
			<a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
			<a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
			<a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
			<a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
		</div>
		</div>
	</section>

	<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">
		<a href="{{ route('front.index')}}" class="logo"><img src="{{ asset('images/gema-logo.png') }}" style="max-height: 60px;" alt="brand logo"></a>

		<nav id="navbar" class="navbar">
			<ul>
			<li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="{{ route('front.index') }}">Home</a></li>
			<li><a class="nav-link scrollto {{ request()->is('profil') ? 'active' : '' }}" href="{{ route('front.profile') }}">Profil</a></li>
			<li><a class="nav-link scrollto {{ request()->is('layanan') ? 'active' : '' }}" href="{{ route('front.service') }}">Layanan</a></li>
			<li><a class="nav-link scrollto {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('front.contact') }}">Kontak</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav>
		</div>
	</header>

	@yield('content-page')

    <footer id="footer">
        <div class="footer-top">
        <div class="container">
            <div class="row">
            <div class="col-lg-4 col-md-6 footer-contact">
                <h3>PT. GEMA LINTAS SEMESTA</h3>
                <p>
                    Wisma Setia Ciliwung Blok A. 108 Jl. Bukit Duri Tanjakan <br>
                    Tebet, Jakarta Selatan<br>
                    Indonesia <br><br>
                    <strong>Telepon:</strong> 021 8378 3267<br>
                    <strong>Email:</strong> gema.express@yahoo.com<br>
                </p>
            </div>

            <div class="col-lg-4 col-md-6 footer-links">
                <h4>Link</h4>
                <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.index') }}">Home</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.profile') }}">Profil</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.service') }}">Layanan</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('front.contact') }}">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 footer-links">
                <h4>Our Social Networks</h4>
                <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>

            </div>
        </div>
        </div>

        <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>Gema Lintas Semesta</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
        </div>
    </footer>

    <div id="preloader"></div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('bizland/assets/js/main.js') }}"></script>
</body>

</html>