@extends('layouts.patient')

@section('main')
<div class="container mt-5">
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
          <a href="{{ route('radiologist.upload-scan', $patient->id) }}" class="btn btn-primary btn-sm">
            Upload Scan
          </a>
        </td>
        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
        <!-- Status is "Pending" if the scan has not been uploaded -->
        <td>Pending</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
