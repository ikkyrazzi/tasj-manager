@extends('layouts.main')

@section('title', 'Add Project')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Project / Add</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Project</h5>
            <a href="{{ route('projects.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder="Project name"
                        required
                    />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        class="form-control"
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="Project description"
                        required
                    ></textarea>
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select
                        class="form-select"
                        id="team_id"
                        name="team_id"
                        required
                    >
                        <option value="" disabled selected>Assign to Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
