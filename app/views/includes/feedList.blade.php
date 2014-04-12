<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Feed Name</td>
			<td>About</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($feeds as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->feedName }}</td>
			<td>{{ $value->description }}</td>

			<td>
				<a class="btn btn-small btn-success" href="#">Subscribe</a>
				<a class="btn btn-small btn-info" href="{{ URL::to('feeds/' . $value->id) }}">Profile</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
