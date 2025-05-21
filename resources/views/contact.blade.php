@extends('layouts.main')

@section('title', 'Contact Us')

@section('content')
    <div class="row mb-5">
        <div class="col-md-6">
            <h1>Contact Us</h1>
            <p class="lead">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </div>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Send us a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Contact Information</h3>
                    <div class="mb-4">
                        <h5><i class="fas fa-map-marker-alt text-primary me-2"></i> Address</h5>
                        <p class="mb-0">123 Book Street</p>
                        <p>New York, NY 10001</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="fas fa-phone text-primary me-2"></i> Phone</h5>
                        <p class="mb-0">Toll-free: (800) 123-4567</p>
                        <p>Local: (212) 555-0123</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="fas fa-envelope text-primary me-2"></i> Email</h5>
                        <p class="mb-0">info@bookstore.com</p>
                        <p>support@bookstore.com</p>
                    </div>
                    <div>
                        <h5><i class="fas fa-clock text-primary me-2"></i> Business Hours</h5>
                        <p class="mb-0">Monday - Friday: 9:00 AM - 8:00 PM</p>
                        <p class="mb-0">Saturday: 10:00 AM - 6:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Follow Us</h3>
                    <div class="d-flex justify-content-around">
                        <a href="#" class="text-primary fs-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-info fs-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-danger fs-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-primary fs-3"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.3059445135!2d-74.25986613799748!3d40.69714941774136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1644913355465!5m2!1sen!2s" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection 