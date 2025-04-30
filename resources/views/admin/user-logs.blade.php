@extends('layouts.admin')

@section('main')
<div class="container wide-container mt-5">
  <h3 class="mb-4">User Logs</h3>
  
  <!-- Search Bar -->
  <div class="row mb-3">
    <div class="col-md-4">
      <form method="GET" action="{{ route('admin.user.logs') }}" class="input-group">
        <input
          type="text"
          name="query"
          class="form-control input-big"
          placeholder="Search user name..."
          value="{{ request('query') }}"
        >
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
        <tr>
          <td>
            <a 
              href="{{ route('admin.patients.edit', $user->id) }}" 
              class="btn btn-sm btn-outline-primary"
            >
              {{ $user->name }}
            </a>
          </td>
          <td>{{ $user->id }}</td>
          <td>{{ ucfirst($user->role) }}</td>
          <td>{{ $user->hospital_code ?? 'N/A' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
