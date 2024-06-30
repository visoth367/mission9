<!-- resources/views/front/course_details.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} Details</title>
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/front_sidebar.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 40px 20px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-img-top {
            border-radius: 8px 8px 0 0;
            max-height: 300px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            color: #666;
            margin-bottom: 15px;
        }
        .video-container {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <header>
    <!-- Your header content here -->
    </header>
    <aside class="custom-sidebar">
        @include('layout.sidebar')
    </aside>  
    <div class="container mt-5">
        <h2>{{ $course->title }}</h2>
        <div class="card">
            @if ($course->image_url)
                <img src="{{ asset($course->image_url) }}" class="card-img-top img-fluid" alt="{{ $course->title }}">
            @else
                <img src="https://via.placeholder.com/800x400.png?text=Course+Image" class="card-img-top img-fluid" alt="Course Image">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $course->title }}</h5>
                <p class="card-text">{{ $course->description }}</p>
                <p class="card-text"><strong>Price:</strong> ${{ $course->price }}</p>
                <p class="card-text"><strong>Rating:</strong> {{ $course->rating }}</p>
                @if ($course->video_url)
                    <div class="video-container">
                        <iframe src="{{ asset($course->video_url) }}" allowfullscreen></iframe>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
