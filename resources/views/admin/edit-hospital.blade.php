{{-- resources/views/admin/edit-hospital.blade.php --}}

@extends('layouts.admin')

@section('main')
<div class="container my-5" style="max-width: 800px; margin: 0 auto;">
  <h2 class="text-3xl mb-5 text-left">Edit Hospital #{{ $hospital->id }}</h2>

  @if(session('success'))
    <div class="alert alert-success mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('hospital.update', $hospital->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Hospital Information --}}
    <div class="card p-4 mb-4">
      <h5 class="mb-3">Hospital Information</h5>

      <div class="mb-3 row">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
          <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $hospital->name) }}"
            class="form-control w-full px-3 py-2 border rounded"
            required
          >
          @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="address" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
          <input
            type="text"
            name="address"
            id="address"
            value="{{ old('address', $hospital->address) }}"
            class="form-control w-full px-3 py-2 border rounded"
            required
          >
          @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="license" class="col-sm-3 col-form-label">License Type</label>
        <div class="col-sm-9">
          <select
            name="license"
            id="license"
            class="form-select form-control w-full px-3 py-2 border rounded"
            required
          >
            <option value="">-- Select License --</option>
            <option value="free"    {{ old('license', $hospital->license) == 'free'    ? 'selected' : '' }}>Free Tier</option>
            <option value="monthly" {{ old('license', $hospital->license) == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly"  {{ old('license', $hospital->license) == 'yearly'  ? 'selected' : '' }}>Yearly</option>
            <option value="business"{{ old('license', $hospital->license) == 'business'? 'selected' : '' }}>Business</option>
          </select>
          @error('license')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    {{-- PIC Details --}}
    <div class="card p-4 mb-4">
      <h5 class="mb-3">PIC Details</h5>

      <div class="mb-3 row">
        <label for="pic_name" class="col-sm-3 col-form-label">PIC Name</label>
        <div class="col-sm-9">
          <input
            type="text"
            name="pic_name"
            id="pic_name"
            value="{{ old('pic_name', $hospital->pic_name) }}"
            class="form-control w-full px-3 py-2 border rounded"
            required
          >
          @error('pic_name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="pic_contact" class="col-sm-3 col-form-label">PIC Contact</label>
        <div class="col-sm-9">
          <input
            type="text"
            name="pic_contact"
            id="pic_contact"
            value="{{ old('pic_contact', $hospital->pic_contact) }}"
            class="form-control w-full px-3 py-2 border rounded"
            required
          >
          @error('pic_contact')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="secondary_contact" class="col-sm-3 col-form-label">Secondary Contact</label>
        <div class="col-sm-9">
          <input
            type="text"
            name="secondary_contact"
            id="secondary_contact"
            value="{{ old('secondary_contact', $hospital->secondary_contact) }}"
            class="form-control w-full px-3 py-2 border rounded"
          >
          @error('secondary_contact')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="pic_username" class="col-sm-3 col-form-label">PIC Email (Username)</label>
        <div class="col-sm-9">
          <input
            type="email"
            name="pic_username"
            id="pic_username"
            value="{{ old('pic_username', $hospital->pic_username) }}"
            class="form-control w-full px-3 py-2 border rounded"
            required
          >
          @error('pic_username')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    {{-- Security --}}
    <div class="card p-4 mb-4">
      <h5 class="mb-3">Security</h5>

      <div class="mb-3 row">
        <label for="pic_password" class="col-sm-3 col-form-label">
          New Password <small class="text-muted">(leave blank to keep current)</small>
        </label>
        <div class="col-sm-9">
          <input
            type="password"
            name="pic_password"
            id="pic_password"
            class="form-control w-full px-3 py-2 border rounded"
            autocomplete="new-password"
          >
          @error('pic_password')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label for="pic_password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
        <div class="col-sm-9">
          <input
            type="password"
            name="pic_password_confirmation"
            id="pic_password_confirmation"
            class="form-control w-full px-3 py-2 border rounded"
            autocomplete="new-password"
          >
        </div>
      </div>
    </div>

    {{-- Actions --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary px-5">Update</button>
      <a href="{{ route('hospital.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
</div>
@endsection
