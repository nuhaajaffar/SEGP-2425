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
<main>
    <h3>license</h3>
</main> 
@endsection
