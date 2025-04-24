{{-- resources/views/admin/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Email Verification</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h5>Signup Form</h5>

    {{-- Display validation or mail errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('otp.signup.send') }}" method="POST">
      @csrf

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input
          type="text"
          name="name"
          class="form-control"
          placeholder="Enter your name"
          value="{{ old('name') }}"
          required
        />
      </div>

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
        <input
          type="text"
          name="phone"
          class="form-control"
          placeholder="Enter phone number"
          value="{{ old('phone') }}"
          required
        />
      </div>

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input
          type="email"
          name="email"
          class="form-control"
          placeholder="Enter email"
          value="{{ old('email') }}"
          required
        />
      </div>

      <div class="mb-3 input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input
          type="password"
          name="password"
          class="form-control"
          placeholder="Enter password"
          required
        />
      </div>

      {{-- Generate and submit OTP server‑side --}}
      <input type="hidden" name="otp" value="{{ rand(100000, 999999) }}" />
      <input type="hidden" name="subject" value="Received OTP" />

      <button type="submit" class="btn btn-primary w-100">Signup</button>
    </form>
  </div>
</body>
</html>
