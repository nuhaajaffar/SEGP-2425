@extends('layouts.patient')

@section('main')
<div class="container wide-container">
  <h2 class="mb-4">Patient Dashboard</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>NO</th>
        <th>ID</th>
        <th>IC</th>
        <th>NAME</th>
        <th>CATEGORY</th>
        <th>STATUS</th>
        <th>DATE</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      @if($patients->isEmpty())
        <tr>
          <td colspan="8">No patients found.</td>
        </tr>
      @else
        @foreach($patients as $index => $patient)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $patient->id }}</td>
            <td>{{ $patient->ic }}</td>
            <td>{{ $patient->name }}</td>
            
            {{-- CATEGORY --}}
            <td>
              @if($patient->reports->isEmpty())
                Prepare for Scanning
              @elseif(!$patient->appointments->isEmpty())
                Consultation
              @else
                Sent for Scan Review
              @endif
            </td>

            {{-- STATUS --}}
            <td>
              @if($patient->reports->where('status', 'complete')->isNotEmpty())
                Completed
              @else
                Pending
              @endif
            </td>

            <td>{{ $patient->created_at->format('d/m/Y') }}</td>

            <td>
              <a href="{{ route('management.patient.edit', $patient->id) }}" class="btn btn-primary btn-sm">Edit</a>
              <a href="{{ route('management.appointment', $patient->id) }}" class="btn btn-secondary btn-sm">Appointment</a>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
@endsection