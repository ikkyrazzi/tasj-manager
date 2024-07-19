@extends('layouts.main')

@section('title', 'Add Task')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task / Add</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Task</h5>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        id="title"
                        name="title"
                        placeholder="Task title"
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
                    ></textarea>
                </div>
                <div class="mb-3">
                    <label for="project_id" class="form-label">Project</label>
                    <select
                        class="form-control"
                        id="project_id"
                        name="project_id"
                        placeholder="Project name"
                        required
                    >
                    <option value="" disabled selected>Select project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">Assign To</label>
                    <select
                        name="user_id"
                        id="user_id"
                        class="form-control"
                        required
                    >
                        <option value="" disabled selected>Select user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                        <option value="" disabled selected>Select status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input
                        type="date"
                        class="form-control"
                        id="due_date"
                        name="due_date"
                        required
                    />
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
