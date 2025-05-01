@extends('layouts.radiologist')

@section('main')
    @if(session()->has('hospital_user') && isset($user))
        <style>
        .avatar-initial {
          width: 120px;
          height: 120px;
          margin: 0 auto 20px;
          border-radius: 50%;
          background: #6c63ff;
          color: #fff;
          font-size: 48px;
          font-weight: 600;
          display: flex;
          align-items: center;
          justify-content: center;
          user-select: none;
          flex-shrink: 0;
        }
        </style>

        <div class="container my-5">
          <h2 class="mb-4">Account Settings</h2>
          <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row gy-4">
              {{-- Avatar --}}
              <div class="col-lg-4">
                <div class="card text-center p-4">
                  @php $initial = strtoupper(substr($user->name,0,1)); @endphp
                  @if($user->profile_photo)
                    <img src="{{ asset('storage/'.$user->profile_photo) }}"
                         class="rounded-circle mb-3"
                         style="width:120px; height:120px; object-fit:cover;">
                  @else
                    <div class="avatar-initial mb-3">{{ $initial }}</div>
                  @endif
                  <div class="mb-3 text-start">
                    <label class="form-label">Change Photo</label><br>
                    <input type="file" name="profile_photo" class="form-control form-control-sm">
                    @error('profile_photo')<div class="text-danger small">{{ $message }}</div>@enderror
                  </div>
                </div>
              </div>

              {{-- Sections --}}
              <div class="col-lg-8">
                {{-- Profile Information --}}
                <div class="card p-4 mb-4">
                  <h5 class="mb-3">Profile Information</h5>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name"
                             value="{{ old('name',$user->name) }}"
                             class="form-control">
                      @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email"
                             value="{{ old('email',$user->email) }}"
                             class="form-control">
                      @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                {{-- Security --}}
                <div class="card p-4 mb-4">
                  <h5 class="mb-3">Security</h5>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control">
                      <small class="text-muted">Leave blank to keep current</small>
                      @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password_confirmation" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Actions --}}
            <div class="text-end mt-4"><br>
              <button type="submit" class="btn btn-primary px-4">Save Changes</button>
              <a href="{{ route('radiographer.profile', $user->id) }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
          </form>
        </div>
    @else
        <div class="container my-5">
          <div class="alert alert-warning text-center">
            You must <a href="{{ route('login') }}">log in</a> to view or edit your account settings.
          </div>
        </div>
    @endif
@endsection
