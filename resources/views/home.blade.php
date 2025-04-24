<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelence - AI Medical Consulting</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
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
            color: #00bfff;
        }

        header nav a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background: #00bfff;
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
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
            transition: background 0.3s ease, transform 0.3s ease;
        }

        header .btn:hover {
            background: #5146d8;
            transform: scale(1.05);
        }

        .ai-intro-section {
            background: #000000;
            color: white;
            padding: 120px 0;
        }

        .intro-content {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            gap: 20px;
        }

        .ai-intro-section img {
            max-width: 600px;
            border-radius: 10px;
            flex-shrink: 0;
            transform: translateX(20%);
        }

        .intro-text-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            max-width: 650px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .intro-text-container h1 {
            margin-top: 0;
            font-size: 42px;
        }

        .intro-text-container p {
            font-size: 16px;
            line-height: 1.5;
        }

        /* How it works section */
        .process-overview {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 80px 50px;
            background: #fff;
            gap: 40px;
            flex-wrap: wrap;
        }

        .steps-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 500px;
        }

        .step-card {
            background: #f5f5f5;
            padding: 15px 20px;
            border-left: 5px solid #080279;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1s ease forwards;
        }

        .step-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .step-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .step-card:nth-child(3) {
            animation-delay: 0.6s;
        }

        .step-card:nth-child(4) {
            animation-delay: 0.8s;
        }

        .step-card:nth-child(5) {
            animation-delay: 1s;
        }

        .process-overview img {
            max-width: 400px;
            border-radius: 10px;
            opacity: 0;
            transform: scale(0.9);
            animation: fadeInZoom 1.2s ease forwards;
            animation-delay: 0.5s;
        }

        .step-card h3 {
            margin: 0 0 8px 0;
            color: #222;
            font-size: 18px;
        }

        .step-card p {
            margin: 0;
            color: #555;
            font-size: 14px;
        }

        /* Animations */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInZoom {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Benefits Section */
        .benefits-section {
            display: flex;
            justify-content: space-around;
            padding: 150px 20px;
            background: linear-gradient(135deg, #f4f8fb, #e9f1f9);
            flex-wrap: wrap;
        }

        .benefit-card {
            background: linear-gradient(135deg, #ffffff, #eef3f9);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            flex: 1 1 300px;
            margin: 15px;
            max-width: 350px;
            text-align: center;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1s ease forwards;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(0px) scale(1.02);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .benefit-card h3 {
            margin-bottom: 15px;
            color: #2a3b8f;
            font-size: 20px;
        }

        .benefit-card p {
            color: #444;
            font-size: 15px;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .intro-content,
            .process-overview {
                flex-direction: column;
                text-align: center;
            }

            .intro-text-container,
            .steps-container {
                max-width: 90%;
            }

            .ai-intro-section img,
            .process-overview img {
                margin-top: 20px;
                transform: none;
            }

            .benefits-section {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo" style="color: #fff; font-weight: bold;">Pixelence</div>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            <a href="#how-it-works">How it Works</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('license') }}">Licenses</a>
        </nav>
        <button class="btn" onclick="window.location='{{ route('login') }}'">
            Log In
        </button>
    </header>

    <section class="ai-intro-section">
        <div class="intro-content">
            <div class="intro-text-container">
                <h1>Revolutionizing Healthcare <br /> with AI Connects Patients & <br />Doctors</h1>
                <p>Our AI-Driven Technology Analyses MRI Scans With Precision, Detecting Tumours <br />Quickly And Accurately To Assist in Early Diagnosis And Treatment Planning, Enhancing Healthcare Efficiency And Patient Outcomes.</p>
            </div>
            <img src="Images/aiBrain.jpg" alt="AI Brain Scan">
        </div>
    </section>

    


    <section class="process-overview" id="how-it-works">
        <img src="Images/websiteBrain.jpg" alt="MRI Scan">
        <div class="steps-container">
            <div class="step-card">
                <h3>1. Upload Medical Scan</h3>
                <p>Patients or radiologists upload MRI scans securely to our platform.</p>
            </div>
            <div class="step-card">
                <h3>2. AI-Powered Tumor Detection</h3>
                <p>Our AI engine analyzes the scan to detect and highlight tumor regions.</p>
            </div>
            <div class="step-card">
                <h3>3. Radiologist Review & Report Upload</h3>
                <p>Certified radiologists review the AI results and add their expert insights.</p>
            </div>
            <div class="step-card">
                <h3>4. AI-Generated Report Assistance</h3>
                <p>The AI system assists in generating detailed diagnostic reports.</p>
            </div>
            <div class="step-card">
                <h3>5. Doctor Review & Treatment Planning</h3>
                <p>Doctors use the report for treatment planning, ensuring fast patient care.</p>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="benefit-card">
            <h3>Enhanced Diagnostic Accuracy</h3>
            <p>Combines AI precision with expert radiologist oversight to reduce errors and improve early tumor detection.</p>
        </div>
        <div class="benefit-card">
            <h3>Faster Workflow, Faster Decisions</h3>
            <p>Automates tumor detection and report generation, cutting reporting time and accelerating the path to treatment.</p>
        </div>
        <div class="benefit-card">
            <h3>Seamless Clinical Integration</h3>
            <p>Easily fits into existing radiology workflows and hospital systems, ensuring smooth adoption without disrupting current processes.</p>
        </div>
    </section>

    <footer style="background: #0f0f0f; color: #fff; padding: 40px 20px;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;">
            <div style="flex: 1 1 300px; margin-bottom: 20px;">
                <h3 style="margin-bottom: 10px;">Pixelence</h3>
                <p style="color: #aaa; font-size: 14px;">Empowering healthcare with AI-driven precision and faster diagnosis for improved patient care.</p>
            </div>
            <div style="flex: 1 1 200px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#how-it-works" style="color: #aaa; text-decoration: none; font-size: 14px;">How it works</a></li>
                    <li><a href="#" style="color: #aaa; text-decoration: none; font-size: 14px;">Partners</a></li>
                    <li><a href="#" style="color: #aaa; text-decoration: none; font-size: 14px;">Services</a></li>
                </ul>
            </div>
            <div style="flex: 1 1 200px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">Contact</h4>
                <p style="color: #aaa; font-size: 14px;">support@pixelence</p>
                <p style="color: #aaa; font-size: 14px;">+60177382910</p>
            </div>
        </div>
        <div style="border-top: 1px solid #333; text-align: center; margin-top: 20px; padding-top: 20px; color: #777; font-size: 12px;">
            © 2025 Pixelence. All rights reserved.
        </div>
    </footer>

    <script>
        document.querySelector('.btn').addEventListener('click', function () {
            alert('Log In functionality coming soon!');
        });
    </script>
</body>

</html>
