@extends('layouts.radiographer')

@section('main')
<div class="container mt-5">
  <div class="row">
    <!-- Left column: search bar and patient list -->
    <div class="col-md-3">
      <!-- Search Bar -->
      <div class="card mb-3">
        <div class="card-body">
          <form method="GET" action="{{ route('radiographer.patient.search') }}">
            <div class="mb-3">
              <input type="text" name="query" class="form-control" placeholder="Search patient name..." value="{{ request('query') }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
          </form>
        </div>
      </div>
      
      <!-- Patient List -->
      <div class="card">
        <div class="card-header">
          Patients
        </div>
        <ul class="list-group list-group-flush">
          @foreach($patients as $patient)
            <li class="list-group-item" style="cursor:pointer;"
                onclick="window.location='{{ route('patient.history', $patient->id) }}'">
              {{ $patient->name }} (ID: {{ $patient->id }})
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
