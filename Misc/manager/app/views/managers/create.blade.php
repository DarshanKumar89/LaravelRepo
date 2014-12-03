<!-- app/views/managers/create.blade.php -->

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
		<li><a href="{{ URL::to('managers/create') }}">Create a Nerd</a>
	</ul>
</nav>

<h1>Create a Schema</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'managers')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('label', 'label') }}
		{{ Form::text('label', Input::old('label'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('data', 'data') }}
		{{ Form::text('data', Input::old('data'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the Schema!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>