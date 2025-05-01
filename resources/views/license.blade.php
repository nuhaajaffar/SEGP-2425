<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelence - Licenses</title>
   
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            background: #000;
            color: #eee;
        }

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

        
        header nav a:hover {
            color:#00bfff;
        }
        header nav a::after {
            content: "";
            display: block;
            height: 2px;
            width: 0;
            background: #00bfff;
            transition: width 0.3s;
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        header nav a:hover::after {
            width: 100%;
        }

        header .btn {
            background: #6c63ff;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        header .btn:hover {
            background: #5848e5;
        }

        .wrapper {
            max-width: 900px;
            width: 100%;
            margin: 50px auto;
            padding: 0 20px;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: #fff;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .license-box,
        .custom-license {
            background: #121212;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 320px;
        }

        .license-box:hover,
        .custom-license:hover {
            transform: translateY(-5px);
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.15), rgba(0, 191, 255, 0.05));
            box-shadow: 0 8px 20px rgba(0, 191, 255, 0.3);
        }

        .license-box h3,
        .custom-license h3 {
            margin-top: 0;
            font-size: 1.4rem;
            color: #00bfff;
            margin-bottom: 15px;
        }

        ul {
            padding-left: 20px;
            margin: 0;
        }

        ul li {
            margin-bottom: 8px;
        }

        .custom-license button.add-btn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 16px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 15px;
            transition: background 0.3s ease;
            width: 100%;
        }

        .custom-license button.add-btn:hover {
            background: #218838;
        }

        .custom-license input,
        .custom-license textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #444;
            background: #1f1f1f;
            color: #eee;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .custom-license button.save-btn {
            background: #00bfff;
            color: #000;
            border: none;
            padding: 10px 16px;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            align-self: flex-start;
        }

        .custom-license button.save-btn:hover {
            background: #009ac1;
        }

        footer {
            background: #0f0f0f;
            color: #fff;
            padding: 40px 20px;
            margin-top: 60px;
        }

        footer .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
        }

        footer a:hover {
            color: #00bfff;
        }

        footer p {
            color: #aaa;
            font-size: 14px;
        }

        .footer-bottom {
            border-top: 1px solid #333;
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            color: #777;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            h2 {
                font-size: 2rem;
            }

            .license-box,
            .custom-license {
                height: auto;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="logo" style="color: #fff; font-weight: bold;">Pixelence</div>
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

    <div class="wrapper">
        <h2>Choose Your License</h2>
        <div class="container">
            <div class="license-box">
                <div>
                    <h3>Free Tier</h3>
                    <ul>
                        <li>Limited number of scans</li>
                        <li>5-15 scans</li>
                        <li>Pay-per scan after trial</li>
                    </ul>
                </div>
            </div>
            <div class="license-box">
                <div>
                    <h3>Yearly Subscription</h3>
                    <ul>
                        <li>Discounted Monthly Pricing</li>
                        <li>Advanced AI access</li>
                        <li>Rollover option</li>
                    </ul>
                </div>
            </div>
            <div class="license-box">
                <div>
                    <h3>Monthly Subscription</h3>
                    <ul>
                        <li>Fixed number of scans</li>
                        <li>50-100 scans</li>
                        <li>Regular Updates</li>
                        <li>Access to all AI tools</li>
                        <li>Rollover option</li>
                    </ul>
                </div>
            </div>
            <div class="license-box">
                <div>
                    <h3>Business</h3>
                    <ul>
                        <li>Custom Pricing</li>
                        <li>Unlimited Scans</li>
                        <li>Multiple Systems</li>
                        <li>Unlimited users</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div style="flex: 1 1 300px; margin-bottom: 20px;">
                <h3 style="margin-bottom: 10px;">Pixelence</h3>
                <p>Empowering healthcare with AI-driven precision and faster diagnosis for improved patient care.</p>
            </div>
            <div style="flex: 1 1 200px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}#how-it-works">How it works</a></li>
                    <li><a href="#">Partners</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </div>
            <div style="flex: 1 1 200px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">Contact</h4>
                <p>support@pixelence.ai</p>
                <p>+60177382910</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 Pixelence. All rights reserved.
        </div>
    </footer>

    <script>
        document.querySelector('.btn').addEventListener('click', function () {
            alert('Sign Up functionality coming soon!');
        });

        function saveCustom() {
            const name = document.getElementById('licenseName').value.trim();
            const desc = document.getElementById('licenseDesc').value.trim();
            if (name && desc) {
                alert(`Custom License Saved!\n\nName: ${name}\nDescription: ${desc}`);
            } else {
                alert('Please fill out both fields.');
            }
        }
    </script>

</body>

</html>
