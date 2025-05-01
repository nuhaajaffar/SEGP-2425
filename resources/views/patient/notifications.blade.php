{{-- resources/views/patient/notifications/index.blade.php --}}
@extends('layouts.patient')

@section('main')
  <div class="container wide-container py-4">
    <h3>Your Notifications</h3>

    @php
      // Always have a Collection to work with
      $notes = $notifications ?? collect();
    @endphp

    @if($notes->isEmpty())
      <div class="alert alert-info">
        You have no new notifications.
      </div>
    @else
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Notification</th>
            <th>Date</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
          @foreach($notes as $note)
            <tr>
              <td>{{ $note->data['message'] }}</td>
              <td>{{ $note->created_at->format('Y-m-d') }}</td>
              <td>{{ $note->created_at->format('g:i A') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <form method="POST" action="{{ route('patient.notifications.read') }}">
        @csrf
        <button class="btn btn-link">Mark All Read</button>
      </form>
    @endif
  </div>
@endsection
