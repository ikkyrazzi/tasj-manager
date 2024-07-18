@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $team->name }}</h1>
    <h3>Members:</h3>
    <ul>
        @foreach($team->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
    <a href="{{ route('teams.index') }}" class="btn btn-primary">Back to Teams</a>
</div>
@endsection
