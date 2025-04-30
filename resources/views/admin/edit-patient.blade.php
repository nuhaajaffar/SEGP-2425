{{-- resources/views/admin/edit-patient.blade.php --}}

@extends('layouts.admin')

@section('main')
<style>
.avatar-initial {
  width: 120px;
  height: 120px;
  margin: 0 auto 20px;
  border-radius: 50%;
  background: #6c63ff;
  color: #fff;
  font-size: 48px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
  flex-shrink: 0;
}
</style>

<div class="container my-5">
  <h2 class="mb-4">Edit Patient #{{ $patient->id }}</h2>

  <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row gy-4">
      {{-- Avatar / Initial --}}
      <div class="col-lg-4">
        <div class="card text-center p-4">
          @php $initial = strtoupper(substr($patient->name, 0, 1)); @endphp

          @if(!empty($patient->profile_photo))
            <img 
              src="{{ asset('storage/'.$patient->profile_photo) }}" 
              class="rounded-circle mb-3" 
              style="width:120px; height:120px; object-fit:cover;"
              alt="Patient Photo"
            >
          @else
            <div class="avatar-initial mb-3">
              {{ $initial }}
            </div>
          @endif

          <p class="text-muted small">Profile photo cannot be changed here.</p>
        </div>
      </div>

      {{-- Form Sections --}}
      <div class="col-lg-8">

        {{-- Profile Information --}}
        <div class="card p-4 mb-4">
          <h5 class="mb-3">Profile Information</h5>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
              <input 
                type="text" 
                name="name" 
                value="{{ old('name', $patient->name) }}" 
                class="form-control"
                required
              >
              @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input 
                type="email" 
                name="email" 
                value="{{ old('email', $patient->email) }}" 
                class="form-control"
                required
              >
              @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>

        {{-- Security --}}
        <div class="card p-4 mb-4">
          <h5 class="mb-3">Security</h5>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
              <input 
                type="password" 
                name="password" 
                class="form-control"
                autocomplete="new-password"
              >
              <small class="text-muted">Leave blank to keep current</small>
              @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Confirm Password</label>
            <div class="col-sm-9">
              <input 
                type="password" 
                name="password_confirmation" 
                class="form-control"
                autocomplete="new-password"
              >
            </div>
          </div>
        </div>

        {{-- Additional Details --}}
        <div class="card p-4 mb-4">
          <h5 class="mb-3">Additional Details</h5>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Contact Number</label>
            <div class="col-sm-9">
              <input 
                type="text" 
                name="contact" 
                value="{{ old('contact', $patient->contact) }}" 
                class="form-control"
                required
              >
              @error('contact')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-9">
              <textarea 
                name="address" 
                class="form-control" 
                rows="3"
              >{{ old('address', $patient->address) }}</textarea>
              @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Hospital Code</label>
            <div class="col-sm-9">
              <input 
                type="text" 
                name="hospital_code" 
                value="{{ old('hospital_code', $patient->hospital_code) }}" 
                class="form-control"
              >
              @error('hospital_code')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>

      </div> {{-- end .col-lg-8 --}}
    </div>   {{-- end .row --}}

    {{-- Actions --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary px-4">Save Changes</button>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
</div>
@endsection
