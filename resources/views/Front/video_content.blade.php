<!-- resources/views/video_content.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Course Detail</title>
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Your custom CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/course_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front_sidebar.css') }}">
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .middle-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .course-details {
            /* Add custom styling for course details if needed */
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
        <div class="row">
            <div class="col-md-6">
                <div class="video-container">
                    <video controls>
                        <source src="{{ $course->video_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="col-md-6 middle-section">
                <h1>{{ $course->title }}</h1>
                <div class="course-details">
                    <p>{{ $course->description }}</p>
                    <div class="mb-3">
                        <span class="fw-bold">Price:</span> ${{ $course->price }}
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Rating:</span> {{ $course->rating }}
                    </div>
                    @if(Auth::check())
                    <form action="{{ route('courses.buy', ['id' => $course->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Purchase Course</button>
                    </form>
                    @else
                    <p>Please <a href="{{ route('login') }}">login</a> to purchase this course.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
