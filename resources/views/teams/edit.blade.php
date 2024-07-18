@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Team</h1>
    <form action="{{ route('teams.update', $team->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $team->name }}" required>
        </div>
        <div class="form-group">
            <label for="users">Members</label>
            <select name="user_ids[]" id="users" class="form-control" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $team->users->contains($user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
