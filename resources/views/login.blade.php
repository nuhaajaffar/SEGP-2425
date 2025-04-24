@extends('layouts.default')

@section('main')
<style>
body {
  background-color: white;
  overflow: hidden;
}
    /* Make the sidebar sit on top of everything else */
.sidebar-container {
  position: fixed;       /* keep it in viewport */
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 1000;         /* higher than your login-wrapper */
}

/* Ensure the slide panel itself also stacks above */
.sidebar-container .slide {
  position: absolute;
  z-index: 1001;         /* above the toggle button */
  /* your existing transform/transition rules… */
}

/* And the toggle icon above the wrapper too */
.sidebar-container .toggle {
  position: absolute;
  z-index: 1002;
}
  /* Full-height flex layout */
  .login-wrapper { display: flex; height: 100vh; margin: 0; }
  .panel { flex: 1; display: flex; justify-content: center; align-items: center; position: relative; }
  .left-panel { background: #fff; }
  .right-panel { background: #E8ECF4; }

  /* Back arrow link */
  .back-arrow {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 24px;
    height: 24px;
  }
  .back-arrow img { width: 100%; height: auto; }

  .form-box { width: 80%; max-width: 400px; display: flex; flex-direction: column; align-items: center; }
  .input-box { width: 100%; margin-bottom: 15px; }
  .input-box input { width: 100%; padding: 10px; font-size: 16px; }
  .login-heading { font-weight: bold; font-size: 30px; text-align: center; margin-bottom: 20px; }
  
  button.login-btn {
    width: 100%;            /* Increase width for a longer button */
    margin: 20px auto 0;   /* Center horizontally with auto side margins */
    padding: 14px 0;
    background: black;
    color: white;
    border: none;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }
  
  .icon { text-align: center; }
  .icon img { display: block; max-width: 100%; height: auto; margin: 0 auto 20px; }
</style>

<div class="login-wrapper">
  <div class="panel left-panel">
    <!-- Back arrow linking to Home -->
    <a href="{{ url('/') }}" class="back-arrow">
      <img src="{{ asset('images/arrow.png') }}" alt="Back">
    </a>

    <div class="form-box">
      <p class="login-heading">Welcome back!</p>
      <br><br>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div class="input-box">
          <input type="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="input-box">
          <input type="password" name="password" required placeholder="Enter your password">
        </div>
        <p style="text-align:right; color:grey; font-size:12px; width:100%;">Forgot password?</p>
        <button type="submit" class="login-btn">Login</button>
      </form>
    </div>
  </div>

  <div class="panel right-panel">
    <div class="icon">
      <img src="{{ asset('images/loginImage.png') }}" alt="Login Illustration" style="max-width:400px; margin-bottom:0;">
      <img src="{{ asset('images/pixelenceLogo.png') }}" alt="Logo" style="max-width:200px; margin-top:0;">
    </div>
  </div>
</div>
@endsection