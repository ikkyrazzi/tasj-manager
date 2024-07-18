@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Project: {{ $task->project->name }}</p>
    <p>Assigned to: {{ $task->user->name }}</p>
    <p>Status: {{ $task->status }}</p>
    <p>Due Date: {{ $task->due_date }}</p>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Tasks</a>
</div>
@endsection
