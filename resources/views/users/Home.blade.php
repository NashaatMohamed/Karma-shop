
@extends("users.layouts")

@section("content")
	<!-- start banner Area -->
    @include("users.home.banner")
	<!-- End banner Area -->

    {{-- start freatures area --}}
        @include("users.home.features")
    {{-- end freatures area --}}

	<!-- Start category Area -->
	@include("users.home.category")
	<!-- End category Area -->

	<!-- start product Area -->
	@include("users.home.latestproduct")
	<!-- end product Area -->

	<!-- Start exclusive deal Area -->
        @include("users.home.exculsive")
	<!-- End exclusive deal Area -->

	<!-- Start brand Area -->
    @include("users.home.brand")
	<!-- End brand Area -->

	<!-- Start related-product Area -->
    @include("users.home.relatedproduct")
	<!-- End related-product Area -->
@endsection
