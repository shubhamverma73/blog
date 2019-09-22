@extends('layout/index')@section('content')
	<div class="hero-wrap hero-bread" style="background-image: url({{ asset('assets/images/bg_1.jpg') }});">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
					<h1 class="mb-0 bread">Products</h1>
				</div>
			</div>
		</div>
	</div>
	@php
		$fruits = '';
		$vegetable = '';
		$juice = '';
		$dried = '';
	@endphp
	@if (Request::segment(2) == 1)
		@php $fruits = 'class="active"'; @endphp
	@elseif (Request::segment(2) == 2)
		@php $vegetable = 'class="active"'; @endphp
	@elseif (Request::segment(2) == 3)
		@php $juice = 'class="active"'; @endphp
	@elseif (Request::segment(2) == 4)
		@php $dried = 'class="active"'; @endphp
	@endif

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 mb-5 text-center">
					<ul class="product-category">
						<li><a href="{{ url('/all-products') }}">All</a></li>
						<li><a href="{{ url('/products/1') }}" @php echo $fruits @endphp >Fruits</a></li>
						<li><a href="{{ url('/products/2') }}" @php echo $vegetable @endphp >Vegetables</a></li>					
						<li><a href="{{ url('/products/3') }}" @php echo $juice @endphp >Juice</a></li>
						<li><a href="{{ url('/products/4') }}" @php echo $dried @endphp >Dried</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
			@foreach($data['product'] as $product)
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="product">
						<a href="#" class="img-prod">
							<img class="img-fluid" src="{{ asset('assets/images/'.$product->image) }}" alt="Colorlib Template">
							<span class="status">30%</span>
							<div class="overlay"></div>
						</a>
						<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#">{{ $product->name }}</a></h3>
							<div class="d-flex">
								<div class="pricing">
									<p class="price"><span class="mr-2 price-dc">{{ $product->dp_price }}</span><span class="price-sale">{{ $product->price }}</span></p>
								</div>
							</div>
							<div class="bottom-area d-flex px-3">
								<div class="m-auto d-flex">
									<a href="javacript:void(0)" id="{{ $product->id }}" class="buy-now d-flex justify-content-center align-items-center mx-1 add-to-cart">
									<span><i class="icon-shopping_cart"></i></span>
									</a>
									<a href="javacript:void(0)" class="heart d-flex justify-content-center align-items-center ">
									<span><i class="icon-heart"></i></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$(document).ready(function() {
		$('.add-to-cart').on('click', function(e) {
			var product_id = $(this).attr('id');
			$.ajax({
					type: 'POST',
					url: "{{ url('/add-to-cart') }}",
					data: {
							_token: "{{ csrf_token() }}",
							product_id: product_id
						 },
					success:function(data) {
					  	$("#msg").html(data.msg);
					}
				});
		});
	});
</script>
@endsection