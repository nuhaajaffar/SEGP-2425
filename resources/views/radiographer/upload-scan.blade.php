@extends('layouts.radiographer')

@section('main')
<div class="wide-container mt-5" style="display: flex; gap: 20px;">
  <!-- Left Column: Upload Scan -->
  <div style="flex: 1;">
    <div class="card mb-4" style="border: 2px solid #ccc; border-radius: 8px; padding: 20px;">
      <div class="card-header" style="text-align: center; border-bottom: 2px solid #ccc;">
        <h3>Upload Scan</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('radiographer.upload.store', $patient->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group mb-3">
            <label for="scan" style="font-weight: bold;">Choose Scan File (PDF, JPG, PNG)</label>
            <input type="file" name="scan" id="scan" class="form-control-file" style="margin-top: 10px;">
            @error('scan')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%;">Upload Scan</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Right Column: Patient History -->
  <div style="flex: 1;">
    <div class="card right-box" style="border: 2px solid #ccc; border-radius: 8px; padding: 30px; height: 420px; display: flex; flex-direction: column; justify-content: space-between;">
      <div>
        <h1 style="text-align: center; padding-bottom: 20px;">Patient History</h1>
        <p><strong>Name:</strong> {{ $patient->name }}</p>
        <p><strong>IC:</strong> {{ $patient->ic }}</p>
        <p><strong>Address:</strong> {{ $patient->address }}</p>
        <p><strong>Contact No:</strong> {{ $patient->contact }}</p>
        <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
        <p><strong>Sex:</strong> {{ ucfirst($patient->sex) }}</p>
      </div>
      <button class="button" style="width: 80%; align-self: center;">Mark as Complete</button>
    </div>
  </div>
</div>
@endsection
