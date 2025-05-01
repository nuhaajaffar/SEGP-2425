{{-- resources/views/admin/user.blade.php --}}
@extends('layouts.admin')

@section('main')
<div class="container mt-5">
    <h1 class="mb-4">User Registration</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- Full Name -->
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input name="name" value="{{ old('name') }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- IC Number -->
        <div class="mb-3">
            <label class="form-label">IC Number</label>
            <input name="ic" value="{{ old('ic') }}" class="form-control" required>
            @error('ic') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" value="{{ old('dob') }}" class="form-control" required>
            @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Sex -->
        <div class="mb-3">
            <label class="form-label">Sex</label>
            <select name="sex" class="form-select" required>
                <option value="">Select Sex</option>
                <option value="male"   {{ old('sex')=='male'   ? 'selected':'' }}>Male</option>
                <option value="female" {{ old('sex')=='female' ? 'selected':'' }}>Female</option>
            </select>
            @error('sex') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="">Select Role</option>
                <option value="hospital management" {{ old('role')=='hospital management'? 'selected':'' }}>Hospital Management</option>
                <option value="hospital admin"      {{ old('role')=='hospital admin'     ? 'selected':'' }}>Hospital Admin</option>
                <option value="radiographer"        {{ old('role')=='radiographer'       ? 'selected':'' }}>Radiographer</option>
                <option value="radiologist"         {{ old('role')=='radiologist'        ? 'selected':'' }}>Radiologist</option>
                <option value="doctor"              {{ old('role')=='doctor'             ? 'selected':'' }}>Doctor</option>
                <option value="patient"             {{ old('role')=='patient'            ? 'selected':'' }}>Patient</option>
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Hospital Dropdown -->
        <div class="mb-3">
            <label class="form-label">Hospital</label>
            <select
              name="hospital_code"
              class="form-select @error('hospital_code') is-invalid @enderror"
              required
            >
              <option value="">— Select your Hospital —</option>
              @foreach($hospitals as $h)
                <option value="{{ $h->code }}"
                  {{ old('hospital_code')==$h->code ? 'selected':'' }}>
                  {{ $h->name }} ({{ $h->code }})
                </option>
              @endforeach
            </select>
            @error('hospital_code')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contact -->
        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input name="contact" value="{{ old('contact') }}" class="form-control" required>
            @error('contact') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label class="form-label">Username (Email)</label>
            <input name="username" value="{{ old('username') }}" class="form-control" required>
            @error('username') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
