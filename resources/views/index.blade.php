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
  body{
    overflow: hidden;
  }
  .login-wrapper { display: flex; height: 100vh; margin: 0; }
  .panel { flex: 1; display: flex; justify-content: center; align-items: center; position: relative; }
  .left-panel { background: #fff; }
  .right-panel { background: #E8ECF4; }

  .form-box { width: 80%; max-width: 400px; display: flex; flex-direction: column; align-items: center; }
  .input-box { width: 100%; margin-bottom: 15px; }
  .input-box input { width: 100%; padding: 10px; font-size: 16px; }
  .login-heading { font-weight: bold; font-size: 30px; text-align: center; margin-bottom: 20px; }
  
  button.login-btn {
    width: 100%;            /* Full-width button */
    margin: 20px auto 0;
    padding: 14px 0;
    background: black;
    color: white;
    border: none;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
  }

  .sidebar-container {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;    /* anything higher than your panels */
  height: 100%;     /* full-height sidebar */
}
.slide {
  /* if you need it to push other content aside: */
  position: absolute;
  left: 0;
  top: 0;
}
  
  .icon { text-align: center; }
  .icon img { display: block; max-width: 100%; height: auto; margin: 0 auto 20px; }
</style>

<div class="login-wrapper">
  <div class="panel left-panel">
    <div class="form-box">
      <p class="login-heading">Welcome Back!</p><br>

      @if($errors->any())
        <div class="alert alert-danger w-100">
          <ul class="mb-0">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('otp.signup.send') }}" method="POST" class="w-100">
        @csrf
        <div class="input-box">
          <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required />
        </div>
        <div class="input-box">
          <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}" required />
        </div>
        <div class="input-box">
          <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required />
        </div>
        <div class="input-box">
          <input type="password" name="password" class="form-control" placeholder="Enter password" required />
        </div>

        <input type="hidden" name="otp" value="{{ rand(100000, 999999) }}" />
        <input type="hidden" name="subject" value="Received OTP" />

        <button type="submit" class="login-btn">Send OTP</button>
      </form>
    </div>
  </div>

  <div class="panel right-panel">
    <div class="icon">
      <img src="{{ asset('images/loginImage.png') }}" alt="Sign Up Illustration" style="max-width:400px; margin-bottom:0;">
      <img src="{{ asset('images/pixelenceLogo.png') }}" alt="Logo" style="max-width:200px; margin-top:0;">
    </div>
  </div>
</div>
@endsection
