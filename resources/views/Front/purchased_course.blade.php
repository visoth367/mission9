<!-- resources/views/front/purchased_course.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchased Courses</title>
    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/front_sidebar.css') }}">
    <style>
        .course-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: auto;
        }
        .card-body {
            flex: 1;
            padding:10px;
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
        <h2>Purchased Courses</h2>
        <div class="row">
            @foreach ($purchasedCourses as $purchasedCourse)
            <div class="col-md-4">
                <div class="card course-card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($purchasedCourse->course->image_url)
                                <img src="{{ asset($purchasedCourse->course->image_url) }}" alt="{{ $purchasedCourse->course->title }}" class="img-fluid">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $purchasedCourse->course->title }}</h5>
                                <!-- <p class="card-text"><strong>Description:</strong> {{ $purchasedCourse->course->description }}</p> -->
                                <p class="card-text"><strong>Price:</strong> ${{ $purchasedCourse->course->price }}</p>
                                <p class="card-text"><strong>Rating:</strong> {{ $purchasedCourse->course->rating }}</p>
                                <!-- Add more details as needed -->
                                <!-- Example: Display video if available -->
                                <!-- @if ($purchasedCourse->course->video_url)
                                    <video width="100%" controls>
                                        <source src="{{ asset($purchasedCourse->course->video_url) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif -->
                                <a href="{{ route('courses.show', $purchasedCourse->course->id) }}" class="btn btn-primary mt-2">View Course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
