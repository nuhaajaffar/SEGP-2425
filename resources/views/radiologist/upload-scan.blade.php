@extends('layouts.patient')

@section('main')
<div class="container mt-5">
  <h3>Upload Scan for Patient: {{ $patient->name }}</h3>
  
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  
  <form action="{{ route('radiologist.upload.store', $patient->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
      <label for="scan">Choose Scan File</label>
      <input type="file" name="scan" id="scan" class="form-control-file">
      @error('scan')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Upload Scan</button>
  </form>
</div>
@endsection
