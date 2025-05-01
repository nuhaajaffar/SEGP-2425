{{-- resources/views/verify.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verify OTP</title>
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
    <h5 class="mb-3">Verify OTP</h5>

    @if(isset($email) && $email)
      <div class="alert alert-info">
        A code was sent to: <strong>{{ $email }}</strong>
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('otp.verify.submit') }}" method="POST">
      @csrf
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="fas fa-key"></i></span>
        <input
          type="text"
          name="otp"
          class="form-control"
          placeholder="Enter your OTP"
          required
        />
      </div>
      <button type="submit" class="btn btn-primary w-100">
        Verify OTP
      </button>
    </form>
  </div>
</body>
</html>
