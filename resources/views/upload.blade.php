@extends('layouts.default')

@section('main')
<div class="container mt-5">
  <h1 class="mb-4">Upload Image</h1>
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
      <label for="image">Choose Image</label>
      <input type="file" name="image" class="form-control-file" id="image">
      @error('image')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-3">Upload</button>
  </form>
</div>
@endsection
