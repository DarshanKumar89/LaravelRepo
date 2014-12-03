<!-- app/views/managers/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Look! I'm CRUDding</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('managers') }}">Alert</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('managers') }}">View All Schemas</a></li>
		<li><a href="{{ URL::to('managers/create') }}">Create a Schemas</a>
	</ul>
</nav>

<h1>All the Schemas</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Label</td>
			<td>Schemas</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($managers as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->label }}</td>
			<td>{{ $value->data }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the managers (uses the destroy method DESTROY /managers/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
{{ Form::open(array('url' => 'managers/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this managers', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show the nerd (uses the show method found at GET /managers/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('managers/' . $value->id) }}">Show this Schemas</a>

				<!-- edit this nerd (uses the edit method found at GET /managers/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('managers/' . $value->id . '/edit') }}">Edit this Schemas</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>