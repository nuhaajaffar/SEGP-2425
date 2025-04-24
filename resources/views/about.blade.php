<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Pixelence | AI-Powered Healthcare</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', Arial, sans-serif;
        }

        body {
            background: #0A0A0A;
            color: #EDEDED;
            line-height: 1.6;
        }

        /* Navbar Styling */
        header {
            background: #0f0f0f;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            color: #EDEDED;
            text-decoration: none;
            font-size: 1rem;
            position: relative;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #00bfff;
        }

        nav a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background: #00bfff;
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        .btn {
            background: #6c63ff;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background: #5146d8;
            transform: scale(1.05);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 120px 20px;
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.12), rgba(0, 191, 255, 0.05));
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #00BFFF;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            color: #D1D1D1;
        }

        /* Section Styling */
        .section {
            max-width: 1000px;
            margin: 80px auto;
            padding: 0 20px;
            text-align: center;
        }

        .section h2 {
            font-size: 2.3rem;
            font-weight: 700;
            color: #FFF;
            margin-bottom: 20px;
        }

        .section p {
            font-size: 1.1rem;
            color: #D1D1D1;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Highlight Boxes */
        .highlights {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }

        .highlight-box {
            background: #121212;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 191, 255, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            flex: 1;
            min-width: 280px;
            max-width: 320px;
        }

        .highlight-box:hover {
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.15), rgba(0, 191, 255, 0.05));
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 191, 255, 0.3);
        }

        .highlight-box h3 {
            font-size: 1.5rem;
            color: #00BFFF;
            margin-bottom: 10px;
        }

        .highlight-box p {
            font-size: 1rem;
            color: #CCC;
        }

        /* Footer */
        footer {
            background: #0f0f0f;
            padding: 40px 20px;
            color: #fff;
            text-align: center;
            margin-top: 80px;
        }

        footer p {
            font-size: 0.9rem;
            color: #A5A5A5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .highlights {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">Pixelence</div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('home') }}#how-it-works">How it Works</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('license') }}">Licenses</a>
        </nav>
        <button class="btn" onclick="window.location='{{ route('login') }}'">
            Log In
        </button>
    </header>

    <div class="hero">
        
        <h1>About Pixelence</h1>
        <p>Revolutionizing healthcare with AI-powered medical imaging. Speed, accuracy, and innovation—delivered.</p>
    </div>

    <div class="section">
        <h2>Our Vision</h2>
        <p>At Pixelence, we aim to bridge the gap between technology and healthcare, enabling faster, more precise diagnoses worldwide.</p>
    </div>

    <div class="section">
        <h2>Why Choose Pixelence?</h2>
        <div class="highlights">
            <div class="highlight-box">
                <h3>AI-Driven Precision</h3>
                <p>Our advanced AI models analyze medical images with pinpoint accuracy, minimizing human errors.</p>
            </div>
            <div class="highlight-box">
                <h3>Lightning-Fast Results</h3>
                <p>Our AI streamlines diagnosis, reducing report turnaround times from hours to mere minutes.</p>
            </div>
            <div class="highlight-box">
                <h3>Seamless Integration</h3>
                <p>Works with existing healthcare infrastructures, ensuring a hassle-free adoption process.</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Our Impact</h2>
        <p>We've empowered hospitals and clinics worldwide, enhancing diagnostic efficiency and improving patient care.</p>
    </div>

    <footer>
        <p>© 2025 Pixelence. All rights reserved.</p>
    </footer>

    <script>
        document.querySelector('.btn').addEventListener('click', function () {
            alert('Log In functionality coming soon!');
        });
    </script>

</body>

</html>
