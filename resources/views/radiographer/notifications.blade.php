@extends('layouts.radiographer')

@section('main')
  <div class="container wide-container py-4">
    <h3>Radiographer Notifications</h3>

    @php $notes = $notifications ?? collect(); @endphp

    @if($notes->isEmpty())
      <div class="alert alert-info">No notifications.</div>
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
      <form action="{{ route('radiographer.notifications.read') }}" method="POST">
        @csrf
        <button class="btn btn-primary">Mark All Read</button>
      </form>
    @endif
  </div>
@endsection