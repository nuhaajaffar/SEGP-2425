@extends('layouts.doctor')

@section('main')
<div class="container mt-5" style="max-width:600px;">
  <h2>Book Consultation</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('doctor.consultation.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Patient</label>
      <select name="patient_id" class="form-select" required>
        <option value="">— Select a patient —</option>
        @foreach($patients as $p)
          <option value="{{ $p->id }}" {{ old('patient_id')==$p->id?'selected':'' }}>
            {{ $p->name }} (ID: {{ $p->id }})
          </option>
        @endforeach
      </select>
      @error('patient_id')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Date &amp; Time</label>
      <input type="datetime-local"
             name="appointment_date"
             class="form-control"
             value="{{ old('appointment_date') }}"
             required>
      @error('appointment_date')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <button class="btn btn-primary w-100">Book Consultation</button>
  </form>
</div>
@endsection
