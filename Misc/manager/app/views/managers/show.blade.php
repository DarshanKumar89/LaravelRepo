<!-- app/views/managers/show.blade.php -->

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
		<li><a href="{{ URL::to('managers') }}">View All Schema</a></li>
		<li><a href="{{ URL::to('managers/create') }}">Create a Schema</a>
	</ul>
</nav>

<h1>Showing {{ $managers->name }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $managers->name }}</h2>
		<p>
			<strong>Label:</strong> {{ $managers->label }}<br>
			<strong>Schema:</strong> {{ $managers->data }}
		</p>
	</div>

</div>
</body>
</html>