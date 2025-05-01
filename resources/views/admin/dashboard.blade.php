{{-- resources/views/admin/dashboard.blade.php --}}

@extends('layouts.admin')

@section('main')
<div class="container wide-container mt-5">
  <h2 class="mb-4">Patient Overview</h2>

  <table class="table table-striped table-hover">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Patient Name</th>       {{-- ← new column --}}
        <th>Hospital Name</th>
        <th>Hospital Code</th>
        <th>Patient IC</th>
        <th>Role</th>
        <th>Status</th>
        <th>Date Joined</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($patients as $patient)
        <tr>
          <td>{{ $patient->id }}</td>
          <td>{{ $patient->name }}</td> {{-- ← show patient name --}}
          <td>{{ optional($patient->hospital)->name ?? '—' }}</td>
          <td>{{ $patient->hospital_code }}</td>
          <td>{{ $patient->ic }}</td>
          <td>{{ strtoupper($patient->role) }}</td>
          <td>{{ $patient->created_at->format('d/m/Y') }}</td>
          <td>{{ $patient->status ?? '—' }}</td>
          <td>
            <a href="{{ route('admin.patients.edit', $patient->id) }}"
              class="btn btn-sm btn-outline-primary ms-2">
                Edit
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center">No patients found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  <!-- Add User Button -->
  <div class="row mt-3">
    <div class="col text-end">
      <a href="{{ route('register.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-1"></i> Add User
      </a>
    </div>
  </div>
</div>
@endsection
