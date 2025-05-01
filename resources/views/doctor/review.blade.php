@extends('layouts.doctor')

@section('main')
<div class="wide-container mt-5" style="display: flex; gap: 20px;">
  <!-- Left Column: Two Stacked Boxes -->
  <div style="flex: 1; display: flex; flex-direction: column; gap: 20px;">
    
    <!-- Box 1: Patient Reports Listing (View Report) -->
    <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 20px;">
      <div class="card-header" style="text-align: center; border-bottom: 2px solid #ccc;">
        <h3>Patient Reports</h3>
      </div>
      <div class="card-body">
        @if($patient->reports && $patient->reports->isNotEmpty())
          <ul class="list-group">
            @foreach($patient->reports as $report)
              <li class="list-group-item">
                <a href="{{ asset($report->report_path) }}" target="_blank" class="btn btn-primary">
                  {{ basename($report->report_path) }}
                </a>
              </li>
            @endforeach
          </ul>
        @else
          <p>No reports generated for this patient yet.</p>
        @endif
      </div>
    </div>

    <!-- Box 2: View Scans -->
    <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 20px;">
      <div class="card-header" style="text-align: center; border-bottom: 2px solid #ccc;">
        <h3>View Scans</h3>
      </div>
      <div class="card-body" style="text-align: center;">
        @if($patient->images && !$patient->images->isEmpty())
          <div class="row">
            @foreach($patient->images as $image)
              <div class="col-md-4 mb-3">
                <div class="card">
                  <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Patient Scan" class="card-img-top img-fluid" style="max-height:200px; object-fit:cover;">
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <p>No scans uploaded for this patient yet.</p>
        @endif
      </div>
    </div>
  </div>
  
  <!-- Right Column: Patient History with Review Box -->
  <div style="flex: 1;">
    <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 30px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
      <div>
        <h3 style="text-align: center; padding-bottom: 20px;">Patient History</h3>
        <p><strong>Name:</strong> {{ $patient->name }}</p>
        <p><strong>IC:</strong> {{ $patient->ic }}</p>
        <p><strong>Address:</strong> {{ $patient->address }}</p>
        <p><strong>Contact:</strong> {{ $patient->contact }}</p>
        <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
        <p><strong>Sex:</strong> {{ ucfirst($patient->sex) }}</p>
        <!-- Review Textarea -->
        <textarea class="review-box" placeholder="Type review..." style="width: 100%; height: 100px; margin-top: 15px;"></textarea>
      </div>
      <div style="text-align: center; padding-top: 20px;">
        <button class="button" style="width: 80%;">Mark as Complete</button>
      </div>
    </div>
  </div>
</div>
@endsection
