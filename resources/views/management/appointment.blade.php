@extends('layouts.hospital')

@section('main')
<div class="wide-container mt-5">
    <h3>Book an Appointment</h3>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('management.appointment.store', $patient->id) }}" method="POST">
        @csrf

        <!-- Pre-populated Patient Information (Read-only) -->
        <fieldset disabled class="mb-4">
            <legend>Patient Information</legend>
            <div class="form-group mb-3">
                <label>Full Name</label>
                <input type="text" class="form-control" value="{{ $patient->name }}">
            </div>
            <div class="form-group mb-3">
                <label>Date of Birth</label>
                <input type="date" class="form-control" value="{{ $patient->dob }}">
            </div>
            <div class="form-group mb-3">
                <label>IC</label>
                <input type="text" class="form-control" value="{{ $patient->ic }}">
            </div>
            <div class="form-group mb-3">
                <label>Address</label>
                <textarea class="form-control" rows="2">{{ $patient->address }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" class="form-control" value="{{ $patient->username }}">
            </div>
        <div class="form-group mb-3">
            <label>Assigned Doctor</label>
            <input
              type="text"
              class="form-control"
              value="{{ optional($patient->assignedDoctor)->name ?? 'N/A' }}"
              disabled>
        </div>

        <div class="form-group mb-3">
            <label>Assigned Radiologist</label>
            <input
              type="text"
              class="form-control"
              value="{{ optional($patient->assignedRadiologist)->name ?? 'N/A' }}"
              disabled>
        </div>

        <div class="form-group mb-3">
            <label>Assigned Radiographer</label>
            <input
              type="text"
              class="form-control"
              value="{{ optional($patient->assignedRadiographer)->name ?? 'N/A' }}"
              disabled>
        </div>
        </fieldset>

        <!-- Assigned Staff (Read-only) -->


        <!-- Appointment Date and Time -->
        <div class="form-group mb-3">
            <label for="appointment_date">Appointment Date & Time</label>
            <input
              type="datetime-local"
              name="appointment_date"
              id="appointment_date"
              class="form-control"
              required>
        </div>

        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</div>
@endsection
