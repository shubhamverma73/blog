@extends('layout/index')

	@section('content')
	<div class="content">
		<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-lg-12 margin-tb">
							<div class="pull-left">
								<h2>Laravel Demo</h2>
							</div>
							<div class="pull-right">
								<a class="btn btn-success" href="{{ url('/register') }}"> Create New User</a>
							</div>
						</div>
					</div>
					@if(session()->has('last_id'))
						 {{ Session::get('last_id') }}
						 {{ session('last_id') }}
					@else 
						 No data in the session
					@endif


					@if ($message = Session::get('message'))
						  <div class="alert alert-success">
								<p>{{ $message }}</p>
						  </div>
					 @endif

					<div class="col-sm-12">
						<div class="row">
							<table id="register" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>ID</th>									
										<th>Name</th>
										<th>Email</th>
										<th>Password</th>
										<th>Date</th>
										<th>Update</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($data['data'] as $user)
										<tr>
											<td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->pass }}</td>
											<td>{{ $user->date }}</td>
											<td><a href = 'edit/{{ $user->id }}' target="_blank">Edit</a></td>
											<td><a href = 'delete/{{ $user->id }}'>Delete</a></td>
										</tr>
									@endforeach
								<tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function () {
	$('#register').DataTable();
});
</script>
@endsection