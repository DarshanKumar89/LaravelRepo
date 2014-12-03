@extends('layouts.main')

@section('content')

	<h2>New Checklist Item</h2>

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

	{{ Form::open() }}

		<input type="text" name="name" placeholder="Your checklist item here...">
		<input type="date" name="date" placeholder="Due date">
		<input type="submit" value="Create Checklist">

	{{ Form::close() }}

@stop