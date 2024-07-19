@extends('layouts.main')

@section('title', 'View Team')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Team / View</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Team Details</h5>
            <a href="{{ route('teams.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <!-- Team Photo -->
            <div class="mb-3 text-center">
                @if($team->photo)
                    <img src="{{ asset('storage/' . $team->photo) }}" alt="Team Photo" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-team-photo.png') }}" alt="Default Team Photo" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                @endif
            </div>
            <!-- Team Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{ $team->name }}"
                    readonly
                />
            </div>
            <!-- Team Members -->
            <div class="mb-3">
                <label for="members" class="form-label">Members</label>
                <div class="d-flex flex-column">
                    @forelse($team->users as $user)
                        <div class="p-2 mb-1 rounded-3 {{ $loop->first ? 'bg-primary text-white' : 'bg-light' }}">
                            {{ $user->name }}
                        </div>
                    @empty
                        <div class="p-2 mb-1 rounded-3 bg-light">
                            No members assigned
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
