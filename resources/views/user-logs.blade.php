@extends('layouts.radiographer')

@section('main')
<div class="container wide-container mt-5">
  <h3 class="mb-4">User Logs</h3>
  
  <!-- Search Bar -->
  <div class="row mb-3">
    <div class="col-md-4">
      <form method="GET" action="{{ route('radiographer.user.logs') }}" class="input-group">
        <input type="text" name="query" class="form-control input-big" placeholder="Search user name..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-outline-secondary">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
  </div>
  
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>User ID</th>
        <th>Role</th>
        <th>Hospital Code</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        <tr style="cursor:pointer;" onclick="window.location='{{ route('user.profile', $user->id) }}'">
          <td>{{ $user->name }}</td>
          <td>{{ $user->id }}</td>
          <td>{{ ucfirst($user->role) }}</td>
          <td>{{ $user->hospital_code ?? 'N/A' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
