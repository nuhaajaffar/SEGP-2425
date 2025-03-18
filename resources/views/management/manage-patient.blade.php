@extends('layouts.hospital')

@section('main')
<div class="container wide-container">
  <!-- Navigation Buttons -->
  <div class="row mb-3">
    <div class="col">
      <a href="{{ route('management.manage-user') }}" class="btn btn-secondary">Manage User</a>
      <a href="{{ route('management.manage-patient') }}" class="btn btn-secondary">Manage Patient</a>
    </div>
  </div>
  
  <h2 class="mb-4">Manage Patients</h2>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>NO</th>
        <th>USER ID</th>
        <th>NAME</th>
        <th>ROLE</th>
        <th>DATE JOINED</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      @if($patients->isEmpty())
        <tr>
          <td colspan="6">No patients found.</td>
        </tr>
      @else
        @foreach($patients as $index => $patient)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $patient->id }}</td>
            <td>{{ $patient->name }}</td>
            <td>{{ strtoupper($patient->role) }}</td>
            <td>{{ $patient->created_at->format('d/m/Y') }}</td>
            <td>
              <a href="{{ route('profile.show', $patient->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <a href="{{ route('management.appointment', $patient->id) }}" class="btn btn-secondary btn-sm">Appointment</a>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  
  <!-- Add User Button -->
  <div class="row mt-3">
    <div class="col">
      <a href="{{ route('register.create') }}" class="btn btn-success">Add User</a>
    </div>
  </div>
</div>
@endsection
