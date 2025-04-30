@extends('layouts.admin')

@section('main')
<div class="container wide-container">
  <!-- Nav buttons… -->
  <div class="row mb-3">
    <div class="col">
      <a href="{{ route('management.manage-user') }}" class="btn btn-secondary">Manage User</a>
      <a href="{{ route('management.manage-patient') }}" class="btn btn-secondary">Manage Patient</a>
    </div>
  </div>

  <h2 class="mb-4">Manage Users</h2>
  
  <table class="table table-striped table-hover">
    <thead class="table-light">
      <tr>
        <th>#</th><th>ID</th><th>Name</th><th>Role</th><th>Hospital</th>
        <th>Date Joined</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $i => $user)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ strtoupper($user->role) }}</td>
          <td>{{ optional($user->hospital)->name ?? '—' }}</td>
          <td>{{ $user->created_at->format('d/m/Y') }}</td>
          <td>
            <a href="{{ route('management.user.patients', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="#" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button onclick="return confirm('Delete {{ $user->name }}?')" 
                      class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center">No users found.</td></tr>
      @endforelse
    </tbody>
  </table>
  
  <!-- Add User Button -->
  <div class="row mt-3">
    <div class="col text-end">
      <a href="{{ route('register.create') }}" class="btn btn-success">
        <i class="fas fa-user-plus me-1"></i> Add User
      </a>
    </div>
  </div>
</div>
@endsection
