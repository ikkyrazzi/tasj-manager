@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <h3>Team: {{ $project->team->name }}</h3>
    <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to Projects</a>
</div>
@endsection
