<!-- app/views/managers/edit.blade.php -->

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

<h1>Edit {{ $managers->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::model($managers, array('route' => array('managers.update', $managers->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('label', 'Label') }}
		{{ Form::text('label', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('data', 'Data') }}
		{{ Form::text('data', null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Schema!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>