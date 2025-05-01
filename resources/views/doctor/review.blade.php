@extends('layouts.doctor')

@section('main')
<div class="wide-container mt-5">
  <!-- Top Row: Two Columns -->
  <div style="display: flex; gap: 20px; margin-bottom: 40px;">

    <!-- Left Column: Past Reviews -->
    <div style="flex: 1;">
      <div class="card" style="border:2px solid #ccc; border-radius:8px; padding:20px;">
        <div class="card-header" style="text-align:center; border-bottom:2px solid #ccc;">
          <h3>Past Reviews for {{ $patient->name }}</h3>
        </div>
        <div class="card-body">
          @if($reviews->isNotEmpty())
            <ul class="list-group">
              @foreach($reviews as $rev)
                <li class="list-group-item">
                  <p>{{ $rev->review }}</p>
                  <small class="text-muted">
                    — Dr. {{ $rev->doctor->name }}
                    on {{ $rev->created_at->format('d/m/Y H:i') }}
                  </small>
                </li>
              @endforeach
            </ul>
          @else
            <p class="text-center">No reviews yet.</p>
          @endif
        </div>
      </div>
    </div>

    <!-- Right Column: Patient History + Write Review -->
    <div style="flex: 1;">
      <div class="card" style="border:2px solid #ccc; border-radius:8px; padding:30px; display:flex; flex-direction:column; justify-content:space-between; height:100%;">
        
        <div>
          <h1 class="text-center mb-4">Patient History</h1>
          <p><strong>Name:</strong> {{ $patient->name }}</p>
          <p><strong>IC:</strong> {{ $patient->ic }}</p>
          <p><strong>Address:</strong> {{ $patient->address }}</p>
          <p><strong>Contact:</strong> {{ $patient->contact }}</p>
          <p><strong>DOB:</strong> {{ $patient->dob }}</p>
          <p><strong>Sex:</strong> {{ ucfirst($patient->sex) }}</p>
        </div>

        {{-- Write Review Form --}}
        <form action="{{ route('doctor.review.store', $patient->id) }}" method="POST" style="margin-top:20px;">
          @csrf
          <div class="mb-3">
            <textarea name="review"
                      class="form-control"
                      rows="4"
                      placeholder="Type your review here..."
                      style="width: 100%;"
                      required>{{ old('review') }}</textarea>
            @error('review')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-success w-100">
            Save Review
          </button>
        </form>

      </div>
    </div>

  </div>

  <!-- Bottom Row: Patient Scan Images -->
  <div class="card" style="border:2px solid #ccc; border-radius:8px; padding:20px;">
    <div class="card-header" style="text-align:center; border-bottom:2px solid #ccc;">
      <h3>Patient Scan Images</h3>
    </div>
    <div class="card-body">
      @if($patient->images->isNotEmpty())
        <div class="row gx-3">
          @foreach($patient->images as $image)
            <div class="col-md-4 mb-3">
              <div class="card">
                <a href="{{ asset('storage/'.$image->image_path) }}" target="_blank">
                  <img src="{{ asset('storage/'.$image->image_path) }}"
                       class="card-img-top img-fluid"
                       style="max-height:200px; object-fit:cover;">
                </a>
                <div class="card-body">
                  <p class="small mb-0 text-truncate">{{ $image->image_path }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-center">No scans uploaded yet.</p>
      @endif
    </div>
  </div>
</div>
@endsection
