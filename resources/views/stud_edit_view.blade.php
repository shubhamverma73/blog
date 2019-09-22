@extends('layout/index')

   @section('content')

   <?php $datas = $data['data']; ?>
   <div class="content">
	  	<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		 	<div class="row">
				<div class="col-sm-12">
			   		<div class="row">
						<form action = "<?php echo url('edit/'.$datas->id); ?>" method = "post">
							<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
						
							<table>
								<tr>
									<td>Name</td>
									<td>
										<input type = 'text' name = 'name' value = '<?php echo $datas->name; ?>'/>
									</td>
								</tr>
								<tr>
									<td>Username</td>
									<td>
										<input type = 'text' name = 'email' value = '<?php echo $datas->email; ?>'/>
									</td>
								</tr>
								<tr>
									<td>Password</td>
									<td>
										<input type = 'text' name = 'password' value = '<?php echo $datas->pass; ?>'/>
									</td>
								</tr>
								<tr>
									<td colspan = '2'>
										<input type = 'submit' value = "Update student" />
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection