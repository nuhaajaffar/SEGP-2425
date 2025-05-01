{{-- resources/views/doctor/notifications.blade.php --}}
@extends('layouts.doctor')

@section('main')
  <div class="container wide-container py-4">
    <h3>Doctor Notifications</h3>

    @php
      // Ensure $notifications is always a Collection
      $notes = $notifications ?? collect();
    @endphp

    @if($notes->isEmpty())
      <div class="alert alert-info">You have no new notifications.</div>
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
    @endif
  </div>
@endsection
