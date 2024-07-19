@extends('layouts.main')

@section('title', 'View Task')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task / View</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Task Details</h5>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control"
                    id="title"
                    name="title"
                    value="{{ $task->title }}"
                    readonly
                />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea
                    class="form-control"
                    id="description"
                    name="description"
                    rows="3"
                    readonly
                >{{ $task->description }}</textarea>
            </div>

            <!-- Project -->
            <div class="mb-3">
                <label for="project" class="form-label">Project</label>
                <input
                    type="text"
                    class="form-control"
                    id="project"
                    name="project"
                    value="{{ $task->project->name }}"
                    readonly
                />
            </div>

            <!-- Assigned To -->
            <div class="mb-3">
                <label for="user_id" class="form-label me-3">Assigned To</label>
                <div class="d-flex align-items-center">
                    @if($task->user->profile_photo_path)
                        <img src="{{ asset('storage/' . $task->user->profile_photo_path) }}" alt="User Photo" class="w-px-40 h-auto rounded-circle me-2" />
                    @else
                        <img src="{{ asset('storage/default-profile.png') }}" alt="Default Photo" class="w-px-40 h-auto rounded-circle me-2" />
                    @endif
                    <div>
                        <span>{{ $task->user->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="d-flex flex-column">
                    @foreach(['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                        <div class="p-2 mb-1 rounded-3 {{ $task->status === $value ? 'bg-primary text-white' : 'bg-light' }}">
                            {{ $label }}
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Due Date -->
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input
                    type="text"
                    class="form-control"
                    id="due_date"
                    name="due_date"
                    value="{{ $task->due_date }}"
                    readonly
                />
            </div>

            <!-- Teams -->
            <div class="mb-3">
                <label for="teams" class="form-label">Teams</label>
                <div class="d-flex flex-wrap">
                    @forelse($task->user->teams as $team)
                        <div class="d-flex align-items-center me-3 mb-2">
                            @if($team->photo)
                                <img src="{{ asset('storage/' . $team->photo) }}" alt="Team Photo" class="w-px-40 h-auto rounded-circle me-2" />
                            @else
                                <img src="{{ asset('storage/default-team.png') }}" alt="Default Team Photo" class="w-px-40 h-auto rounded-circle me-2" />
                            @endif
                            <span>{{ $team->name }}</span>
                        </div>
                    @empty
                        <p>No teams assigned</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
