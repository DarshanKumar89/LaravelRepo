@extends('layouts.main')

@section('content')

	{{ Form::open() }}

		<input type="text" name="name" value="" placeholder="The name of your task here..." autocomplete="off">
		<input type="submit" value="Create Task">

	{{ Form::close() }}

	@foreach ($errors->all() as $error)
		<p class="error">{{ $error }}</p>
	@endforeach

@stop