@extends('layouts.hospital')

@section('main')
<div class="container mt-5">
  <h2 class="mb-4">Edit User Profile</h2>
  <form action="{{ route('profile.show', $patient->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Username -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $patient->username) }}" required>
      @error('username')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    
    <!-- Full Name -->
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
      @error('name')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    
    <!-- IC Number -->
    <div class="mb-3">
      <label for="ic" class="form-label">IC Number</label>
      <input type="text" name="ic" id="ic" class="form-control" value="{{ old('ic', $patient->ic) }}" required>
      @error('ic')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    
    <!-- Address -->
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea name="address" id="address" class="form-control" required>{{ old('address', $patient->address) }}</textarea>
      @error('address')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    
    <!-- Hospital ID (Read-only) -->
    <div class="mb-3">
      <label for="hospital_id" class="form-label">Hospital ID</label>
      <input type="text" name="hospital_id" id="hospital_id" class="form-control" value="{{ $patient->hospital_id }}" readonly>
    </div>
    
    <!-- Contact -->
    <div class="mb-3">
      <label for="contact" class="form-label">Contact</label>
      <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact', $patient->contact) }}" required>
      @error('contact')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    
    <!-- Date of Birth and Edit Option -->
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Date of Birth</label>
        <p>{{ $patient->dob }}</p>
      </div>
      <div class="col-md-6">
        <label for="dob" class="form-label">Change Date of Birth</label>
        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $patient->dob) }}" required>
        @error('dob')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    
    <!-- Sex and Edit Option -->
    <div class="row mb-3">
      <div class="col-md-6">
        <label class="form-label">Sex</label>
        <p>{{ ucfirst($patient->sex) }}</p>
      </div>
      <div class="col-md-6">
        <label for="sex" class="form-label">Change Sex</label>
        <select name="sex" id="sex" class="form-select" required>
          <option value="">Select Sex</option>
          <option value="male" {{ old('sex', $patient->sex) == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('sex', $patient->sex) == 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('sex')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    
    <!-- Save Button -->
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
