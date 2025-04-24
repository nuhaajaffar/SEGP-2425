<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pixelence</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" 
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <!-- Sidebar with Toggle -->
  <div class="sidebar-container">
    <input type="checkbox" id="toggleMenu">
    <label for="toggleMenu" class="toggle">
      <span class="top_line common"></span>
      <span class="middle_line common"></span>
      <span class="bottom_line common"></span>
    </label>
    <div class="slide">
      <h1>PIXELENCE</h1>
      <ul>
        <li><a href="{{ route('support') }}"><i class="fas fa-tv"></i> SUPPORT</a></li>
        <li><a href="{{ route('settings') }}"><i class="fas fa-cogs"></i> SETTING</a></li>
        <li><a href="{{ route('privacy') }}"><i class="fas fa-shield"></i> PRIVACY &amp; SECURITY</a></li>
      </ul>
    </div>
  </div>

  <!-- Header Navigation -->
  <header>
    <h2 class="logo">PIXELENCE</h2>
    <nav class="navigation">
      <a href="{{ url('/') }}">Home</a>
      <a href="{{ route('home') }}#how-it-works">How it Works</a>
      <a href="{{ route('about') }}">About Us</a>
      <a href="{{ route('license') }}">Licenses</a>
    </nav>
  </header>

  <!-- Main Content -->
  <main>
    @yield('main')
  </main>
</body>
</html>
