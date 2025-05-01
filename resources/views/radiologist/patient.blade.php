@extends('layouts.radiologist')

@section('main')
<div class="container wide-container mt-5">
  <h3 class="mb-4">Patients</h3>
  
  <!-- Search Bar (Optional) -->
  <div class="row mb-3">
    <div class="col-md-4">
      <form method="GET" action="{{ route('radiologist.patient.search') }}" class="input-group">
      <input type="text" name="query" class="form-control input-big" placeholder="Search patient name..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-outline-secondary">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
  </div>
  
  <!-- Two-Column Table: Name and ID -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>HOSPITAL ID</th>
      </tr>
    </thead>
    <tbody>
      @foreach($patients as $patient)
        <tr style="cursor:pointer;" onclick="window.location='{{ route('radiologist.history', $patient->id) }}'">
          <td>{{ $patient->name }}</td>
          <td>{{ $patient->id }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
