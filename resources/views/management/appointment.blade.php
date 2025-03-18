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
        <fieldset disabled style="margin-bottom:20px;">
            <legend>Patient Information</legend>
            <div class="form-group mb-3">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" class="form-control" value="{{ $patient->name }}">
            </div>
            <div class="form-group mb-3">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" class="form-control" value="{{ $patient->dob }}">
            </div>
            <div class="form-group mb-3">
                <label for="ic">IC:</label>
                <input type="text" id="ic" class="form-control" value="{{ $patient->ic }}">
            </div>
            <div class="form-group mb-3">
                <label for="address">Address:</label>
                <textarea id="address" class="form-control" rows="2">{{ $patient->address }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="username">Patient Username:</label>
                <input type="text" id="username" class="form-control" value="{{ $patient->username }}">
            </div>
        </fieldset>

        <!-- Dropdown for Doctor -->
        <div class="form-group mb-3">
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                <option value="">-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown for Radiologist -->
        <div class="form-group mb-3">
            <label for="radiologist_id">Select Radiologist:</label>
            <select name="radiologist_id" id="radiologist_id" class="form-control">
                <option value="">-- Select Radiologist --</option>
                @foreach($radiologists as $radiologist)
                    <option value="{{ $radiologist->id }}">{{ $radiologist->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown for Radiographer -->
        <div class="form-group mb-3">
            <label for="radiographer_id">Select Radiographer:</label>
            <select name="radiographer_id" id="radiographer_id" class="form-control">
                <option value="">-- Select Radiographer --</option>
                @foreach($radiographers as $radiographer)
                    <option value="{{ $radiographer->id }}">{{ $radiographer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Appointment Date and Time for Doctor -->
        <div class="form-group mb-3">
            <label for="appointment_date">Appointment Date and Time:</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</div>
@endsection
