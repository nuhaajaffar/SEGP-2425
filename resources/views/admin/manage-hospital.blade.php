@extends('layouts.admin')

@section('main')
<div class="container wide-container">
  <h2 class="mb-4">Manage Hospitals</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>HOSPITAL CODE</th>
        <th>HOSPITAL NAME</th>
        <th>DOCTORS</th>
        <th>RADIOLOGISTS</th>
        <th>RADIOGRAPHERS</th>
        <th>PATIENTS</th>
        <th>DATE ADDED</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      @if($hospitals->isEmpty())
        <tr>
          <td colspan="9">No hospitals found.</td>
        </tr>
      @else
        @foreach($hospitals as $index => $hospital)
          <tr>
            <td>{{ $hospital->id }}</td>
            <td>{{ $hospital->code }}</td>
            <td>{{ $hospital->name }}</td>

            {{-- Role counts filtered by hospital_code --}}
            <td>{{ \App\Models\HospitalUser::where('hospital_code', $hospital->code)->where('role', 'doctor')->count() }}</td>
            <td>{{ \App\Models\HospitalUser::where('hospital_code', $hospital->code)->where('role', 'radiologist')->count() }}</td>
            <td>{{ \App\Models\HospitalUser::where('hospital_code', $hospital->code)->where('role', 'radiographer')->count() }}</td>
            <td>{{ \App\Models\Patient::where('hospital_code', $hospital->code)->count() }}</td>

            <td>{{ $hospital->created_at->format('d/m/Y') }}</td>
            <td>
              <a href="{{ route('hospital.edit', $hospital->id) }}" class="btn btn-primary btn-sm">Edit</a>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <!-- Add Hospital Button -->
  <div class="row mt-3">
    <div class="col text-end">
      <a href="/hospital-registration" class="btn btn-success">
        <i class="fas fa-hospital me-1"></i> Add Hospital
      </a>
    </div>
  </div>
</div>
@endsection
