@extends('layouts.radiologist')

@section('main')
<div class="wide-container mt-5">
  <!-- Top Row: Two Columns -->
  <div style="display: flex; gap: 20px; margin-bottom: 40px;">
    <!-- Left Column: Two Stacked Boxes -->
    <div style="flex: 1; display: flex; flex-direction: column; gap: 20px;">
      
      <!-- Box 1: Upload Report (Manual Upload) -->
      <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 20px;">
        <div class="card-header" style="text-align: center; border-bottom: 2px solid #ccc;">
          <h3>Upload Report for Patient: {{ $patient->name }}</h3>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:20px;">
              {{ session('success') }}
            </div>
          @endif
          <form action="{{ route('radiologist.upload.report.store', $patient->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
              <label for="report" style="font-weight: bold;">Choose Report File (PDF only)</label>
              <input type="file" name="report" id="report" class="form-control-file" style="margin-top:10px;">
              @error('report')
                <small style="color:red;">{{ $message }}</small>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Upload Report</button>
          </form>
        </div>
      </div>
      
      <!-- Box 2: Patient Reports Listing -->
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
      
    </div>
    
    <!-- Right Column: Patient History -->
    <div style="flex: 1;">
      <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 30px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
        <div>
          <h1 style="text-align: center; padding-bottom: 20px;">Patient History</h1>
          <p><strong>Name:</strong> {{ $patient->name }}</p>
          <p><strong>IC:</strong> {{ $patient->ic }}</p>
          <p><strong>Address:</strong> {{ $patient->address }}</p>
          <p><strong>Contact:</strong> {{ $patient->contact }}</p>
          <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
          <p><strong>Sex:</strong> {{ ucfirst($patient->sex) }}</p>
        </div>
        <!-- resources/views/radiologist/show.blade.php -->
        <div style="text-align: center; padding-top: 20px;">
          <form action="{{ route('radiologist.patients.complete', $patient->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" style="width: 80%;">Mark as Complete</button>
          </form>        
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bottom Row: Patient Scan Images with Image Path Display -->
  <div class="card" style="border: 2px solid #ccc; border-radius: 8px; padding: 20px; width: 100%;">
    <div class="card-header" style="text-align: center; border-bottom: 2px solid #ccc;">
      <h3>Patient Scan Images</h3>
    </div>
    <div class="card-body">
      @if($patient->images && !$patient->images->isEmpty())
        <div class="row">
          @foreach($patient->images as $image)
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank">
                  <img src="{{ asset('storage/' . $image->image_path) }}" alt="Patient Scan" class="card-img-top img-fluid" style="max-height:200px; object-fit:cover;">
                </a>
                <div class="card-body">
                  <p class="text-center">{{ $image->image_path }}</p>
                </div>
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
@endsection
