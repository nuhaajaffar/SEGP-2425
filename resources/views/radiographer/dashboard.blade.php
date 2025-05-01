@extends('layouts.radiographer')

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
          <td>
            <a href="{{ route('radiographer.upload-scan', $patient->id) }}" class="btn btn-primary btn-sm">
              Upload Scan
            </a>
          </td>
          <td>{{ $patient->created_at->format('Y-m-d') }}</td>
          <td>
            @if($patient->images && $patient->images->isNotEmpty())
              {{ ucfirst($patient->images->first()->status) }}
            @else
              Pending
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
