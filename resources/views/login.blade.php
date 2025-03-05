@extends('layouts.default')

@section('sidebar')
<label>
    <input type="checkbox" id=""toggleMenu>
    <div class="toggle">
        <span class="top_line common"></span>
        <span class="middle_line common"></span>
        <span class="bottom_line common"></span>
    </div>
        
    <div class="slide">
        <h1>PIXELENCE</h1>
        <ul>
            <li><a href="#"><i class="fas fa-globe"></i>LANGUAGE</a></li>
            <li><a href="#"><i class="fas fa-tv"></i>SUPPORT</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i>SETTING</a></li>
            <li><a href="#"><i class="fas fa-shield"></i>PRIVACY & SECURITY</a></li>
        </ul>
    </div>
        
</label>
@endsection


@section('main')
<div class="container mt-5">
    <h1 class="mb-4">User Login</h1>
    
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <!-- We assume the user's email is stored in the "username" field of HospitalUser -->
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection