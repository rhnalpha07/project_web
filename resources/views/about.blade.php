@extends('layouts.main')

@section('title', 'About Us')

@section('content')
    <!-- Hero Section -->
    <div class="bg-light py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold">About BookStore</h1>
                    <p class="lead">Your trusted source for books since 2024. We're passionate about connecting readers with their next favorite book.</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="About BookStore" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <section class="mb-5">
        <div class="container">
            <h2 class="mb-4">Our Story</h2>
            <div class="row">
                <div class="col-md-8">
                    <p>BookStore started with a simple idea: to make quality books accessible to everyone. What began as a small corner shop has grown into a comprehensive online bookstore, serving thousands of happy readers.</p>
                    <p>Our mission is to inspire, educate, and entertain through the power of reading. We believe that books have the ability to transform lives, spark imagination, and foster understanding between people.</p>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h4 class="card-title">Quick Facts</h4>
                            <ul class="list-unstyled">
                                <li>✓ Over 10,000 titles</li>
                                <li>✓ 24/7 Customer support</li>
                                <li>✓ Fast worldwide shipping</li>
                                <li>✓ Competitive prices</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="mb-5 bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Values</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="fas fa-book fa-3x text-primary mb-3"></i>
                        <h4>Quality Selection</h4>
                        <p>We carefully curate our collection to bring you the best books across all genres.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                        <h4>Customer First</h4>
                        <p>Your satisfaction is our top priority. We're here to help you find your perfect read.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="fas fa-globe fa-3x text-primary mb-3"></i>
                        <h4>Community Focus</h4>
                        <p>We believe in building a community of readers and supporting literary education.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="bg-primary text-white py-5 rounded">
        <div class="container text-center">
            <h2 class="mb-4">Want to Know More?</h2>
            <p class="lead mb-4">We'd love to hear from you and answer any questions you may have about our bookstore.</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Contact Us</a>
        </div>
    </section>
@endsection 