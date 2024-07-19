@extends('layouts.main')

@section('title', 'Edit Profile')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Profile / Edit</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Profile</h5>
            <a href="{{ route('profile.index') }}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    />
                </div>
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    />
                </div>
                
                <!-- Profile Photo Field -->
                <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input
                        type="file"
                        class="form-control"
                        id="profile_photo"
                        name="profile_photo"
                    />
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" class="mt-2" style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
