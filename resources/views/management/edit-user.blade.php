@extends('layouts.management')

@section('main')
<div class="container wide-container">
  <h2>Edit Patients for {{ $user->name }} ({{ ucfirst($user->role) }})</h2>
  <form
    action="{{ route('management.user.patients.update', $user->id) }}"
    method="POST"
  >
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Select Patients</label>
      <select
        name="patients[]"
        class="form-select"
        multiple
        size="10"
      >
        @foreach($patients as $p)
          <option
            value="{{ $p->id }}"
            {{ $p->assigned_doctor_id == $user->id ? 'selected':'' }}
          >
            {{ $p->name }} (ID: {{ $p->id }})
          </option>
        @endforeach
      </select>
      <small class="form-text text-muted">
        Use Ctrl/Cmd+Click to select multiple.
      </small>
    </div>

    <button class="btn btn-primary">Save</button>
    <a href="{{ route('management.manage-user') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
