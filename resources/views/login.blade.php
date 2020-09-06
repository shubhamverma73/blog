@extends('layout/index')@section('content')

	@if (Session::has('success'))<div class="alert alert-success">{!! Session::get('success') !!}</div>
	@elseif (Session::has('failed'))<div class="alert alert-danger">{!! Session::get('failed') !!}</div>@endif

	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row block-12">
				<div class="col-md-12 order-md-last d-flex">
					<form action="<?php echo url('/user/signin') ?>" method="post" class="bg-white p-5 contact-form">
						<!-- <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>"> -->
						@csrf
						<div class="form-group">
							<input type="text" name = "email" class="form-control" placeholder="Your Email">
						</div>
						<div class="form-group">
							<input type="password" name = "password" class="form-control" placeholder="Your Password">
						</div>
						<div class="form-group">
							<input type="submit" value="Login" class="btn btn-primary py-3 px-5">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection