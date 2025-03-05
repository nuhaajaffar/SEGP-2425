@extends('layouts.default')

@section('main')
<div class="container mt-5">
    <h1 class="mb-4">Hospital Registration</h1>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('hospital.store') }}" method="POST">
        @csrf

        <!-- Row 1 -->
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Name -->
                <label for="name" class="form-label">Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="form-control" 
                       value="{{ old('name') }}"
                       required>
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <!-- Username for PIC -->
                <label for="pic_username" class="form-label">Username for PIC</label>
                <input type="text" 
                       name="pic_username" 
                       id="pic_username" 
                       class="form-control" 
                       value="{{ old('pic_username') }}"
                       required>
                @error('pic_username')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Address -->
                <label for="address" class="form-label">Address</label>
                <input type="text" 
                       name="address" 
                       id="address" 
                       class="form-control" 
                       value="{{ old('address') }}"
                       required>
                @error('address')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <!-- Password for PIC -->
                <label for="pic_password" class="form-label">Password for PIC</label>
                <input type="password" 
                       name="pic_password" 
                       id="pic_password" 
                       class="form-control" 
                       required>
                @error('pic_password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- PIC's Name -->
                <label for="pic_name" class="form-label">PIC's Name</label>
                <input type="text" 
                       name="pic_name" 
                       id="pic_name" 
                       class="form-control" 
                       value="{{ old('pic_name') }}"
                       required>
                @error('pic_name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <!-- License -->
                <label for="license" class="form-label">License</label>
                <select name="license" id="license" class="form-select" required>
                    <option value="">Select License</option>
                    <option value="free" {{ old('license') == 'free' ? 'selected' : '' }}>Free Tier</option>
                    <option value="monthly" {{ old('license') == 'monthly' ? 'selected' : '' }}>Monthly Subscription</option>
                    <option value="yearly" {{ old('license') == 'yearly' ? 'selected' : '' }}>Yearly Subscription</option>
                    <option value="business" {{ old('license') == 'business' ? 'selected' : '' }}>Business</option>
                </select>
                @error('license')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Row 4 -->
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- PIC's Contact -->
                <label for="pic_contact" class="form-label">PIC's Contact</label>
                <input type="text" 
                       name="pic_contact" 
                       id="pic_contact" 
                       class="form-control" 
                       value="{{ old('pic_contact') }}"
                       required>
                @error('pic_contact')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6">
                <!-- Secondary Contact -->
                <label for="secondary_contact" class="form-label">Secondary Contact</label>
                <input type="text" 
                       name="secondary_contact" 
                       id="secondary_contact" 
                       class="form-control" 
                       value="{{ old('secondary_contact') }}">
                @error('secondary_contact')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Save Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
@endsection
