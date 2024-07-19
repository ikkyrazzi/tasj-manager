@extends('layouts.main')

@section('title', 'My Profile')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Profile / View</span></h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Profile Details</h5>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <!-- Menampilkan foto profil -->
                <div class="me-4">
                    <div class="avatar avatar-xl">
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" class="w-px-100 h-auto rounded-circle" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    value="{{ $user->name }}"
                    readonly
                />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    value="{{ $user->email }}"
                    readonly
                />
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Joined</label>
                <input
                    type="text"
                    class="form-control"
                    id="created_at"
                    value="{{ $user->created_at->format('d M Y') }}"
                    readonly
                />
            </div>
        </div>
    </div>
</div>
@endsection
