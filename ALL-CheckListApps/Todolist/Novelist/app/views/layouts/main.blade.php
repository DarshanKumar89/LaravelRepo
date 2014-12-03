<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Novelist</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

	<div class="container">

		<header>
			<h1>Novelist</h1>
			<p class="subtitle">Below are your tasks</p>
			@yield('header')
		</header><!-- /header -->

		<div class="content">
			@yield('content')
		</div>

	</div><!-- container -->

</body>
</html>