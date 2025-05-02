@extends('layouts.patient')

@section('main')
<div class="container wide-container">
  <h2 class="mb-4">Patient Dashboard</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Doctor</th>
        <th>Radiologist</th>
        <th>Radiographer</th>
        <th>Category</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($patients as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->assignedDoctor->name ?? 'N/A' }}</td>
          <td>{{ $p->assignedRadiologist->name ?? 'N/A' }}</td>
          <td>{{ $p->assignedRadiographer->name ?? 'N/A' }}</td>

          <td>
            @if($p->images->isNotEmpty())
              Scan Uploaded
            @elseif($p->reports->isNotEmpty())
              Report Generated
            @elseif($p->appointments->isNotEmpty())
              Appointment
            @else
              N/A
            @endif
          </td>

          <td>
            @if(
              $p->reports->where('status','complete')->isNotEmpty() ||
              $p->appointments->where('status','complete')->isNotEmpty()
            )
              Completed
            @else
              Pending
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center">No information found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
