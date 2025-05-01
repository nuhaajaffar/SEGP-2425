@extends('layouts.doctor')

@section('main')
<div class="container my-5" style="max-width: 1200px;">
  <h1 class="mb-3">Privacy &amp; Security Policy</h1>
  <p class="text-muted">Last updated: April 25, 2025</p>

  {{-- 1. Introduction & Scope --}}
  <section class="mb-5">
    <h2>1. Introduction &amp; Scope</h2>
    <p>Pixelence (“we”, “us”, “our”) provides AI-powered MRI analysis services. This policy explains what personal and medical data we collect, how we use and protect it, and your rights regarding your information.</p>
  </section>

  {{-- 2. Information We Collect --}}
  <section class="mb-5">
    <h2>2. Information We Collect</h2>
    <ul>
      <li><strong>Personal data:</strong> name, email address, contact details.</li>
      <li><strong>Medical data:</strong> MRI scans, AI-generated reports, diagnostic results.</li>
      <li><strong>Technical data:</strong> IP address, device/browser type, usage logs, cookies.</li>
    </ul>
  </section>

  {{-- 3. How We Use Your Information --}}
  <section class="mb-5">
    <h2>3. How We Use Your Information</h2>
    <ul>
      <li>To process MRI scans and generate diagnostic reports.</li>
      <li>To manage user accounts, authentication, and support requests.</li>
      <li>To send notifications and service announcements.</li>
      <li>To improve our platform through analytics and performance monitoring.</li>
    </ul>
  </section>

  {{-- 4. Data Sharing & Disclosure --}}
  <section class="mb-5">
    <h2>4. Data Sharing &amp; Disclosure</h2>
    <p>We do not sell your personal or medical data. We may share information with:</p>
    <ul>
      <li>Our cloud storage provider (e.g., AWS) for secure data hosting.</li>
      <li>Email delivery services for notifications.</li>
      <li>Analytics partners (e.g., Google Analytics) using aggregated, anonymized data.</li>
      <li>Legal authorities if required by law or court order.</li>
    </ul>
  </section>

  {{-- 5. Data Retention --}}
  <section class="mb-5">
    <h2>5. Data Retention</h2>
    <p>We retain your MRI scans and reports for as long as your account is active plus an additional 30 days. After that, data is securely deleted or anonymized.</p>
  </section>

  {{-- 6. Security Measures --}}
  <section class="mb-5">
    <h2>6. Security Measures</h2>
    <ul>
      <li>Encryption in transit via TLS/HTTPS.</li>
      <li>Encryption at rest using AES-256.</li>
      <li>Role-based access controls and regular security audits.</li>
      <li>Incident response procedures for data breaches.</li>
    </ul>
  </section>

  {{-- 7. Your Rights & Choices --}}
  <section class="mb-5">
    <h2>7. Your Rights &amp; Choices</h2>
    <ul>
      <li><strong>Access &amp; Portability:</strong> Request a copy of your data.</li>
      <li><strong>Correction:</strong> Update or correct inaccurate data.</li>
      <li><strong>Deletion:</strong> Delete your account and data permanently.</li>
      <li><strong>Opt-out:</strong> Unsubscribe from marketing communications.</li>
    </ul>
  </section>

  {{-- 8. Cookies & Tracking --}}
  <section class="mb-5">
    <h2>8. Cookies &amp; Tracking</h2>
    <p>We use cookies for session management, preferences, and analytics. You can disable cookies in your browser settings, but some features may not function correctly.</p>
  </section>

  {{-- 9. Children’s Privacy --}}
  <section class="mb-5">
    <h2>9. Children’s Privacy</h2>
    <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect data from minors.</p>
  </section>

  {{-- 10. Policy Updates --}}
  <section class="mb-5">
    <h2>10. Policy Updates</h2>
    <p>We may update this policy from time to time. Changes will be posted here with a revised “Last updated” date, and important changes may be communicated via email.</p>
  </section>

  {{-- 11. Contact Information --}}
  <section>
    <h2>11. Contact Information</h2>
    <p>If you have questions or requests regarding your data, please contact our Data Protection Officer:</p>
    <ul>
      <li>Email: <a>privacy@pixelence.com</a></li>
      <li>Support: <a>support@pixelence.com</a> | <a>+60 17 738 2910</a></li>
    </ul>
  </section>
</div>
@endsection
