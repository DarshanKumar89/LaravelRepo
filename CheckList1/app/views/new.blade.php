@extends('layouts.main')

@section('content')

	<h2>Create a New Task</h2>

	{{ Form::open() }}

		<input type="text" name="name" placeholder="The name of your task here..." autocomplete="off">
		<input type="submit" value="Create Task">

	{{ Form::close() }}

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

@stop