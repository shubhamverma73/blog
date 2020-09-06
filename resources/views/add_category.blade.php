@if(Session::get('success'))
{!! Session::get('success') !!}
@endif

<section class="ftco-section contact-section bg-light">
	<div class="container">
		<div class="row block-12">
			<div class="col-md-12 order-md-last d-flex">
				<form action="<?php echo url('/add-category') ?>" method="post" class="bg-white p-5 contact-form">
					@csrf
					<div class="form-group">
						<input type="text" name = "name" class="form-control" placeholder="Category Name">
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" class="btn btn-primary py-3 px-5">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>