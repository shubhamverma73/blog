@extends('layout/index')@section('content')
	<div class="hero-wrap hero-bread" style="background-image: url({{ asset('assets/images/bg_1.jpg') }});">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Profile</span></p>
					<h1 class="mb-0 bread">Profile</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Name: </h2>
					<span>{{ $data['profile']->name }}</span>
					<h2 style="font-size: 22px;" class="mb-0">Email: </h2>
					<span>{{ $data['profile']->email }}</span>
				</div>
			</div>
		</div>
	</section>
@endsection