@extends('layouts.main')

@section('title', 'Create Team')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Teams / Create</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Team</h5>
            <a href="{{ route('teams.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Team Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    />
                </div>

                <!-- Photo Field -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Team Photo</label>
                    <input
                        type="file"
                        class="form-control"
                        id="photo"
                        name="photo"
                    />
                </div>

                <!-- Members Field -->
                <div class="mb-3">
                    <label for="users" class="form-label">Members</label>
                    <select
                        name="user_ids[]"
                        id="users"
                        class="form-control"
                        multiple
                        required
                    >
                        @foreach($users as $user)
                            <option
                                value="{{ $user->id }}"
                                class="{{ in_array($user->id, old('user_ids', [])) ? 'bg-primary text-white' : 'bg-light' }}"
                            >
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
