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
      <li><a href="{{ route('profile.show', session('hospital_user')) }}"><i class="fas fa-user"></i> PROFILE</a></li>
        
        <!-- Language Dropdown -->
        <li class="dropdown">
          <a href="#"><i class="fas fa-globe"></i> LANGUAGE</a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('lang.switch', 'en') }}">English</a></li>
            <li><a href="{{ route('lang.switch', 'es') }}">Español</a></li>
            <!-- Add more languages as needed -->
          </ul>
        </li>  
                
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
      <a href="{{ route('radiographer.dashboard') }}">HOME</a>
      <a href="{{ route('radiographer.patient.search') }}">PATIENTS</a>
      <a href="#">NOTIFICATIONS</a> 
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
      <a href="#">PROFILE</a>
    </nav>
    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </header>

  <!-- Main Content -->
  <main>
    @yield('main')
  </main>
</body>
</html>
