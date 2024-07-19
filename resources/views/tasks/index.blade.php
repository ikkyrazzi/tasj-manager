@extends('layouts.main')

@section('title', 'Task')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Task</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Task</h5>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Project</th>
                        <th class="text-center">Assigned To</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Due Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($tasks as $index => $task)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $task->title }}</td>
                        <td class="text-center">{{ $task->project->name }}</td>
                        <td class="text-center">
                            @if($task->user->profile_photo_path)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#userModal{{ $task->user->id }}">
                                    <img src="{{ asset('storage/' . $task->user->profile_photo_path) }}" alt="Profile Photo" class="w-px-40 h-auto rounded-circle" />
                                </a>
                            @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#userModal{{ $task->user->id }}">
                                    <img src="{{ asset('storage/default-profile.png') }}" alt="Default Photo" class="w-px-40 h-auto rounded-circle" />
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($task->status == 'pending')
                                <span class="badge bg-label-warning me-1">Pending</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-label-info me-1">In Progress</span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-label-success me-1">Completed</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $task->due_date }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>
                                    <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Modal untuk menunjukkan nama pengguna dan tim -->
                    <div class="modal fade" id="userModal{{ $task->user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $task->user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $task->user->id }}">{{ $task->user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        @if($task->user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $task->user->profile_photo_path) }}" alt="Profile Photo" class="w-px-150 h-auto rounded-circle" />
                                        @else
                                            <img src="{{ asset('storage/default-profile.png') }}" alt="Default Photo" class="w-px-150 h-auto rounded-circle" />
                                        @endif
                                        <p class="mt-2">{{ $task->user->name }}</p>
                                        <p class="text-muted">{{ $task->user->email }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <h6>Teams</h6>
                                        @forelse($task->user->teams as $team)
                                            <div class="d-flex align-items-center mb-2">
                                                @if($team->photo && file_exists(storage_path('app/public/' . $team->photo)))
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
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
