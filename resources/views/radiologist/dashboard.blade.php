@extends('layouts.radiologist')

@section('main')
<div class="container wide-container">
  <div class="md-4">
    <h3>Patient Activity Table</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>User ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Date Joined</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($patients as $patient)
        <tr>
          <td>{{ $patient->id }}</td>
          <td>{{ $patient->ic ?? $patient->ic }}</td>
          <td>{{ $patient->name }}</td>
          <!-- Since the patient hasn't uploaded an image, the Category is "Upload Scan" -->
          <td>
            <a href="{{ route('radiologist.report', $patient->id) }}" class="btn btn-primary btn-sm">
            Report and Scans
            </a>
          </td>
          <td>{{ $patient->created_at->format('Y-m-d') }}</td>
          <td>{{ ucfirst($patient->status ?? 'pending') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
