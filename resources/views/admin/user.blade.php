@extends('layouts.default')

@section('main')
<div class="container mt-5">
    <h1 class="mb-4">User Registration</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- IC -->
        <div class="mb-3">
            <label for="ic" class="form-label">IC Number</label>
            <input type="text" name="ic" id="ic" class="form-control" value="{{ old('ic') }}" required>
            @error('ic')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
            @error('address')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- DOB -->
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required>
            @error('dob')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Sex -->
        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select name="sex" id="sex" class="form-select" required>
                <option value="">Select Sex</option>
                <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('sex')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="">Select Role</option>
                <option value="hospital management" {{ old('role') == 'hospital management' ? 'selected' : '' }}>Hospital Management</option>
                <option value="hospital admin" {{ old('role') == 'hospital admin' ? 'selected' : '' }}>Hospital Admin</option>
                <option value="radiographer" {{ old('role') == 'radiographer' ? 'selected' : '' }}>Radiographer</option>
                <option value="radiologist" {{ old('role') == 'radiologist' ? 'selected' : '' }}>Radiologist</option>
                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient</option>
            </select>
            @error('role')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Contact -->
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}" required>
            @error('contact')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            @error('username')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
