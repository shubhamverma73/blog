@extends('layout/index')@section('content')

	<style type="text/css">
	/*--thank you pop starts here--*/
	.thank-you-pop{
		width:100%;
	 	padding:20px;
		text-align:center;
	}
	.thank-you-pop img{
		width:76px;
		height:auto;
		margin:0 auto;
		display:block;
		margin-bottom:25px;
	}

	.thank-you-pop h1{
		font-size: 42px;
	    margin-bottom: 25px;
		color:#5C5C5C;
	}
	.thank-you-pop p{
		font-size: 20px;
	    margin-bottom: 27px;
	 	color:#5C5C5C;
	}
	.thank-you-pop h3.cupon-pop{
		font-size: 25px;
	    margin-bottom: 40px;
		color:#222;
		display:inline-block;
		text-align:center;
		padding:10px 20px;
		border:2px dashed #222;
		clear:both;
		font-weight:normal;
	}
	.thank-you-pop h3.cupon-pop span{
		color:#03A9F4;
	}
	.thank-you-pop a{
		display: inline-block;
	    margin: 0 auto;
	    padding: 9px 20px;
	    color: #fff;
	    text-transform: uppercase;
	    font-size: 14px;
	    background-color: #8BC34A;
	    border-radius: 17px;
	}
	.thank-you-pop a i{
		margin-right:5px;
		color:#fff;
	}
	#ignismyModal .modal-header{
	    border:0px;
	}
	/*--thank you pop ends here--*/
	</style>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
					<h1 class="mb-0 bread">Cart</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>Product List</th>
									<th>&nbsp;</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data['cart_data'] as $cart_data)
									<tr class="text-center">
										<td class="product-remove" id="{{ $cart_data['product']['id'] }}"><a href="javascript:void(0)"><span class="icon-close"></span></a></td>
										<td class="image-prod">
											<img class="img" src="{{ asset('assets/images/'.$cart_data['product']['image']) }}" alt="product image">
										</td>
										<td class="product-name">
											<h3>{{ $cart_data['product']['name'] }}</h3>
											<p>{{ $cart_data['product']['short_descprition'] }}</p>
										</td>
										<td class="price"><i class="fa fa-inr" aria-hidden="true"></i> {{ $cart_data['product']['price'] }}</td>
										<td class="quantity">
											<div class="input-group mb-3">
												<input type="text" name="quantity" class="quantity form-control input-number" value="{{ $cart_data['qty'] }}" min="1" max="100">
											</div>
										</td>
										<td class="total"><i class="fa fa-inr" aria-hidden="true"></i> {{ $cart_data['amount'] }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
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

	<!--Model Popup starts-->
	<div class="container">
		<div class="row">
			<!-- <a class="btn btn-primary" data-toggle="modal" href="#ignismyModal">open Popup</a> -->
			<div class="modal fade" id="ignismyModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
						 </div>
						
						<div class="modal-body">
						   
							<div class="thank-you-pop">
								<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
								<h1>Success!</h1>
								<p>Your Product removed from cart successfully</p>
								<!-- <h3 class="cupon-pop">Your Id: <span>12345</span></h3> -->								
							</div>
							 
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Model Popup ends-->

<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function() {
	$('.product-remove').on('click', function() {
		var product_id = $(this).attr('id');
		if(confirm("Are you sure, you want to remove product from cart?")){
			$.ajax({
					type: 'POST',
					url: "{{ url('/remove-to-cart') }}",
					data: {
							_token: "{{ csrf_token() }}",
							cart_id: product_id
						 },
					success:function(data) {
						if(data == 'removeFromCart') {
							$('#ignismyModal').modal('show');
							setTimeout(function(){
							  location.reload(true);
							}, 5000);
						} else {
							alert('Product not remove from cart, please try again.')
						}
					}
			});
		} else {
			return false;
		}
	})
});
</script>
@endsection