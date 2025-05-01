@extends('layouts.radiologist')

@section('main')
<div class="container my-5" style="max-width: 1200px;">
  <h1 class="mb-4">Support Center</h1>
  <p class="lead mb-5">Can’t find what you’re looking for? Browse our FAQ or send us a ticket below.</p>

  <div class="row">
    {{-- FAQ Column --}}
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Frequently Asked Questions</h5>
        </div>
        <div class="card-body">
          <div class="accordion" id="supportFaq">
            @php
              $faqs = [
                ['q'=>'How do I upload an MRI scan?','a'=>'Go to your Radiographer dashboard, click “Upload Scan,” select your file, then hit “Submit.”'],
                ['q'=>'Why hasn’t my report appeared?','a'=>'AI analysis usually completes within 30 seconds; check Notifications for errors or retry upload.'],
                ['q'=>'How can I reset my password?','a'=>'Click “Forgot password?” on the login screen and follow the instructions sent to your email.'],
                ['q'=>'Can I download previous reports?','a'=>'Yes—on your Radiologist dashboard under “Patient Reports,” click the file name to download.'],
              ];
            @endphp
            @foreach($faqs as $idx => $item)
              <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading{{ $idx }}">
                  <button
                    class="accordion-button {{ $idx ? 'collapsed' : '' }}"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faqCollapse{{ $idx }}"
                    aria-expanded="{{ $idx ? 'false':'true' }}"
                    aria-controls="faqCollapse{{ $idx }}">
                    {{ $item['q'] }}
                  </button>
                </h2>
                <div
                  id="faqCollapse{{ $idx }}"
                  class="accordion-collapse collapse {{ $idx===0?'show':'' }}"
                  aria-labelledby="faqHeading{{ $idx }}"
                  data-bs-parent="#supportFaq">
                  <div class="accordion-body">
                    {{ $item['a'] }}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    {{-- Ticket Form Column --}}
    <div class="col-lg-6">
      <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Submit a Support Ticket</h5>
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form action="{{ route('support.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                class="form-control"
                placeholder="Brief summary"
                required>
              @error('subject')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea
                id="message"
                name="message"
                rows="6"
                class="form-control"
                placeholder="Describe your issue in detail"
                required>{{ old('message') }}</textarea>
              @error('message')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
              <label for="attachment" class="form-label">Attachment (optional)</label>
              <input
                type="file"
                id="attachment"
                name="attachment"
                class="form-control">
              @error('attachment')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-success w-100">
              Send Ticket
            </button>
          </form>
        </div>
        <div class="card-footer text-muted text-center">
            <div class="mb-2">
                <small>Our support team is available <strong>Mon–Fri, 9 am–6 pm</strong>.</small>
            </div>
            <div>
                <small>Contact us at
                    <a>support@pixelence.com</a>
                    or call
                    <a>+60 17 738 2910</a>
                </small>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
