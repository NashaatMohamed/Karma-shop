<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href={{asset("assets/img/fav.png")}}>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href={{asset("assets/css/linearicons.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/font-awesome.min.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/themify-icons.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/bootstrap.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/owl.carousel.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/nice-select.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/nouislider.min.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/ion.rangeSlider.css")}} />
	<link rel="stylesheet" href={{asset("assets/css/ion.rangeSlider.skinFlat.css")}} />
	<link rel="stylesheet" href={{asset("assets/css/magnific-popup.css")}}>
	<link rel="stylesheet" href={{asset("assets/css/main.css")}}>
</head>

<body>
	<!-- start header Area -->
        @include("users.layouts.header")
	<!-- End header Area -->

@yield("content")

	<!-- start footer Area -->
        @include("users.layouts.footer");
	<!-- End footer Area -->

	<script src={{asset("assets/js/vendor/jquery-2.2.4.min.js")}}></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src={{asset("assets/js/vendor/bootstrap.min.js")}}></script>
	<script src={{asset("assets/js/jquery.ajaxchimp.min.js")}}></script>
	<script src={{asset("assets/js/jquery.nice-select.min.js")}}></script>
	<script src={{asset("assets/js/jquery.sticky.js")}}></script>
	<script src={{asset("assets/js/nouislider.min.js")}}></script>
	<script src={{asset("assets/js/countdown.js")}}></script>
	<script src={{asset("assets/js/jquery.magnific-popup.min.js")}}></script>
	<script src={{asset("assets/js/owl.carousel.min.js")}}></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src={{asset("assets/js/gmaps.min.js")}}></script>
	<script src={{asset("assets/js/main.js")}}></script>
</body>

</html>
