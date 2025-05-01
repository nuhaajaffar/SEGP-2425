@extends('layouts.admin')

@section('main')
<div class="container wide-container">
  <h2>Edit Patient Assignments: {{ $patient->name }}</h2>
  <form
    action="{{ route('management.patient.update', $patient->id) }}"
    method="POST"
  >
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Doctor</label>
      <select name="assigned_doctor_id" class="form-select">
        <option value="">— none —</option>
        @foreach($doctors as $doc)
          <option
            value="{{ $doc->id }}"
            {{ $patient->assigned_doctor_id == $doc->id ? 'selected':'' }}
          >
            {{ $doc->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Radiologist</label>
      <select name="assigned_radiologist_id" class="form-select">
        <option value="">— none —</option>
        @foreach($radiologists as $rad)
          <option
            value="{{ $rad->id }}"
            {{ $patient->assigned_radiologist_id == $rad->id ? 'selected':'' }}
          >
            {{ $rad->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Radiographer</label>
      <select name="assigned_radiographer_id" class="form-select">
        <option value="">— none —</option>
        @foreach($radiographers as $rg)
          <option
            value="{{ $rg->id }}"
            {{ $patient->assigned_radiographer_id == $rg->id ? 'selected':'' }}
          >
            {{ $rg->name }}
          </option>
        @endforeach
      </select>
    </div>

    <button class="btn btn-primary">Save</button>
    <a href="{{ route('management.manage-patient') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
