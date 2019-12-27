@foreach($data['flights'] as $all_records)
	<div class="alert alert-success">
		<p>{{ $all_records->name }} <img src="{{ asset('assets/images/'.$all_records->image) }}" height="40" width="40"></p>
	</div>
@endforeach