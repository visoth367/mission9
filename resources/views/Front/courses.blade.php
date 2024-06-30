<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Page</title>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>

<body>
    <!-- Header -->
    <header class="header">
    @include('layout.header')
    </header>

    <!-- Courses Section -->
    <div class="courses-container">
        <h2 class="section-title">Our Courses</h2>
        <div class="course-filters">
            <input type="text" placeholder="Search for courses">
            <select>
                <option value="popularity">Popularity</option>
                <option value="rating">Rating</option>
                <option value="newest">Newest</option>
            </select>
        </div>
        <!-- get the data from the database -->
        <div class="course-list">
            @foreach($courses as $course)
                <div class="course-item">
                    <a href="{{ route('video_content', $course->id) }}">
                        <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
                    </a>
                    <h4>{{ $course->title }}</h4>
                    <p>{{ $course->thumbnail }}</p>
                    <div class="course-price">${{ $course->price }}</div>
                    <div class="course-rating">Rating: {{ $course->rating }}</div>
                </div>
            @endforeach
        </div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-logo">
                <h1 class="logo">
                    <img src="Image/Logo.png" alt="logo">
                </h1>
            </div>
            <div class="footer-links">
                <div>
                    <h4>Top Category</h4>
                    <ul>
                        <li><a href="#" class="text-white">Design</a></li>
                        <li><a href="#" class="text-white">Development</a></li>
                        <li><a href="#" class="text-white">Marketing</a></li>
                        <li><a href="#" class="text-white">Business</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                        <li><a href="#" class="text-white">Support</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-app">
                <h4>Download Our App</h4>
                <button class="btn btn-primary">App Store</button>
                <button class="btn btn-primary">Google Play</button>
            </div>
        </div>
    </footer>
</body>

</html>