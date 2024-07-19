@extends('layouts.main')

@section('title', 'Teams')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Teams</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Teams</h5>
            <a href="{{ route('teams.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($teams as $index => $team)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $team->name }}</td>
                        <td class="text-center">
                            @if($team->photo)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal{{ $team->id }}">
                                    <img src="{{ asset('storage/' . $team->photo) }}" alt="Team Photo" class="w-px-40 h-auto rounded-circle" />
                                </a>
                            @else
                                <span>No Photo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('teams.show', $team->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>
                                    <a class="dropdown-item" href="{{ route('teams.edit', $team->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
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
                    
                    <!-- Modal for Team Photo -->
                    <div class="modal fade" id="teamModal{{ $team->id }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $team->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="teamModalLabel{{ $team->id }}">{{ $team->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    @if($team->photo)
                                        <img src="{{ asset('storage/' . $team->photo) }}" alt="Team Photo" class="w-px-150 h-auto rounded-circle" />
                                    @else
                                        <p>No Photo Available</p>
                                    @endif
                                    <p class="mt-2">{{ $team->name }}</p>
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
