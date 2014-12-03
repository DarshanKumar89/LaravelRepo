@extends('layouts.main')

@section('content')
	<p class="tasks">
		
	</p>
	<ul class="task-list">

	<a href="{{ URL::to('/new/checklist') }}" class="button new-task-btn">New Checklist Item</a>


		@foreach ($checklists as $checklist)
			@if ($checklist->id)
				<li class="sub-tasks">
					{{ Form::open() }}
						<input type="checkbox" name="id" onClick="this.form.submit()" value="{{ $checklist->id }}" {{ $checklist->done ? 'checked' : '' }}>
						{{ $checklist->name }}
						<span class="due-date">
							Due Date: {{ $checklist->due_date }}						
						</span>
					{{ Form::close() }}
				</li>
			@else
				<p>There are no sub-tasks</p>
			@endif
		@endforeach

		
	</ul>

@stop
