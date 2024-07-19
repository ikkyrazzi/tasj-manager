@extends('layouts.main')

@section('title', 'View Project')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Project / View</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Project Details</h5>
            <a href="{{ route('projects.index') }}" class="btn btn-primary">Kembali</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{ $project->name }}"
                    readonly
                />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control"
                    id="description"
                    name="description"
                    rows="3"
                    readonly
                >{{ $project->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="team_id" class="form-label">Team</label>
                <input
                    type="text"
                    class="form-control"
                    id="team_id"
                    name="team_id"
                    value="{{ $project->team->name }}"
                    readonly
                />
            </div>
        </div>
    </div>
</div>
@endsection
