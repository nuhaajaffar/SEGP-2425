@extends('layouts.default')

@section('sidebar')
<label>
    <input type="checkbox" id="toggleMenu">
    <div class="toggle">
        <span class="top_line common"></span>
        <span class="middle_line common"></span>
        <span class="bottom_line common"></span>
    </div>
    <div class="slide">
        <h1>PIXELENCE</h1>
        <ul>
            <li><a href="#"><i class="fas fa-globe"></i> LANGUAGE</a></li>
            <li><a href="#"><i class="fas fa-tv"></i> SUPPORT</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> SETTING</a></li>
            <li><a href="#"><i class="fas fa-shield"></i> PRIVACY & SECURITY</a></li>
        </ul>
    </div>
</label>
@endsection

@section('main')
<style>
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