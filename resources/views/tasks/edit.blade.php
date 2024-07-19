@extends('layouts.main')

@section('title', 'Edit Task')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task / Edit</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Task</h5>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        name="title"
                        placeholder="Task title"
                        value="{{ old('title', $task->title) }}"
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
                        placeholder="Task description"
                        required
                    >{{ old('description', $task->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="project" class="form-label">Project</label>
                    <input
                        type="text"
                        class="form-control"
                        id="project"
                        name="project"
                        placeholder="Project name"
                        value="{{ old('project', $task->project->name) }}"
                        required
                    />
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">Assign To</label>
                    <select
                        name="user_id"
                        id="user_id"
                        class="form-control"
                        required
                    >
                        <option value="" disabled>Select user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $task->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select
                        class="form-select"
                        id="status"
                        name="status"
                        required
                    >
                        <option value="" disabled>Select status</option>
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input
                        type="date"
                        class="form-control"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date) }}"
                        required
                    />
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
