@extends('layouts.radiographer')

@section('main')
<div class="container mt-5">
  <h1>Patient History</h1>
  <p><strong>Name:</strong> {{ $patient->name }}</p>
  <p><strong>IC:</strong> {{ $patient->ic }}</p>
  <p><strong>Address:</strong> {{ $patient->address }}</p>
  <p><strong>Date Joined:</strong> {{ $patient->created_at->format('d/m/Y') }}</p>
  <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
  <p><strong>Sex:</strong> {{ ucfirst($patient->sex) }}</p>
  <!-- Add more patient details as needed -->
</div>
@endsection
