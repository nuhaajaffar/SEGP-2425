@extends('layouts.patient')

@section('main')
<div class="container mt-5">
  <h2>Patient Information</h2>
  <p><strong>Name:</strong> {{ $patient->name }}</p>
  <p><strong>IC:</strong> {{ $patient->ic }}</p>
  <p><strong>Address:</strong> {{ $patient->address }}</p>
  <!-- Add other patient fields as needed -->

  <h3>Uploaded Scan</h3>
  @if($patient->image)
    <img src="{{ asset('storage/' . $patient->image->image_path) }}" alt="Patient Scan" style="max-width:100%; height:auto;">
    <p>Scan Uploaded on: {{ $patient->image->created_at->format('Y-m-d') }}</p>
  @else
    <p>No scan uploaded yet.</p>
    <a href="{{ route('patient.upload', $patient->id) }}" class="btn btn-primary">Upload Scan</a>
  @endif
</div>
@endsection
