@extends('layouts.main')

@section('content')
	
	<a href="{{ URL::to('/new') }}" class="button new-task-btn">New Task</a>

	<ul class="task-list">
		@foreach ($items as $item)
			<li class="tasks">
				{{ Form::open() }}
					<input type="checkbox" onClick="this.form.submit()" {{ $item->done ? 'checked' : '' }}>
					<input type="hidden" name="id" value="{{ $item->id }}">
					<a href= '{{ URL::to("/item/$item->id") }}' >
						{{ $item->name }}
					</a>
					<small class="non-cursive">(<a href="{{ URL::route('edit', $item->id) }}">Edit</a>)</small>					
					<small class="non-cursive">(<a href="{{ URL::route('delete', $item->id) }}">x</a>)</small>
				{{ Form::close() }}
			</li>
		@endforeach
	</ul>

@stop