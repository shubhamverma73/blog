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
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="{{ asset('assets/images/'.$data['product']->image) }}" class="image-popup"><img src="{{ asset('assets/images/'.$data['product']->image) }}" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3>{{ $data['product']->name }}</h3>
					<p class="price"><span>{{ $data['product']->price }}</span></p>
					<p>{{ $data['product']->description }}
					</p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="icon-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">Small</option>
										<option value="">Medium</option>
										<option value="">Large</option>
										<option value="">Extra Large</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
							<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
							<i class="icon-minus"></i>
							</button>
							</span>
							<input type="text" id="quantity" name="quantity" class="form-control input-number" value="@if (@$data['cart_details']->qty > 1) {{ @$data['cart_details']->qty }} @else 1 @endif " min="1" max="100">
							<span class="input-group-btn ml-2">
							<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
							<i class="icon-plus"></i>
							</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;">600 kg available</p>
						</div>
					</div>
					<p>
						<a href="javascript:void(0)" id="{{ $data['product']->id }}" class="btn btn-black buy-now d-flex justify-content-center align-items-center mx-1 add-to-cart"><span>Add to Cart</span></a></p>
				</div>
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
<script>
$(document).ready(function(){
var quantitiy=0;
   $('.quantity-right-plus').click(function(e){e.preventDefault();
		var quantity = parseInt($('#quantity').val())			
		$('#quantity').val(quantity + 1);
	});

	$('.quantity-left-minus').click(function(e){e.preventDefault();
		var quantity = parseInt($('#quantity').val());
		if(quantity>0){
			$('#quantity').val(quantity - 1);
		}
	});	
});

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function() {
	$('.add-to-cart').on('click', function() {
		var product_id = $(this).attr('id');
		var quantity = $('#quantity').val();
		$.ajax({
				type: 'POST',
				url: "{{ url('/add-to-cart') }}",
				data: {
						_token: "{{ csrf_token() }}",
						product_id: product_id,
						quantity: quantity,
					 },
				success:function(data) {
					if(data != 'userNotLogin') {
						if(data == 'addedToCart') {
							$("#cart-quantity").html(quantity);
						} else if(data == 'notAddedToCart') {
							alert('Due to technical error, please try again later');
						}
					} else {
						alert('Plase login first.');
					}
				}
			});
	})
});
</script>
@endsection