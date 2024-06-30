<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/userprofile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topbar.css') }}">
    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table tr:nth-child(odd) {
            background-color: white;
        }

        .custom-table tr:nth-child(even) {
            background-color: lightgray;
        }

        .custom-table td {
            padding: 10px;
        }

        .course-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            height: 100%; /* Ensure full height */
        }

        .course-item img {
            max-width: 100%;
            height: auto;
            width: 100%; /* Ensure full width */
            object-fit: cover; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>
    <main>
        <header>
        </header>
        <aside class="custom-sidebar">
            @include('layout.sidebar')
        </aside>

        <section class="home-section">
            <div class="container">
                <h3>{{ $user->username }}</h3>
                <div class="container-item">
                    <div class="profile-image">
                        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('default-image-url') }}"
                            alt="Profile Image" id="profileImage" class="img-fluid">
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                            
                            <table class="table custom-table">
                                <tr>
                                    <td><p class="card-text">Username:</p></td>
                                    <td><span id="username">{{ $user->username }}</span></td>
                                </tr>
                                <tr>
                                    <td><p class="card-text">Email:</p></td>
                                    <td><span id="email">{{ $user->email }}</span></td>
                                </tr>
                                <tr>
                                    <td><p class="card-text">Gender:</p></td>
                                    <td><span id="gender">{{ $user->gender }}</span></td>
                                </tr>
                                <tr>
                                    <td><p class="card-text">Phone Number:</p></td>
                                    <td><span id="phone_number">{{ $user->phone_number }}</span></td>
                                </tr>
                            </table>

                            <!-- Edit button -->
                            <button class="btn btn-secondary" id="editProfileButton">Edit</button>

                            <!-- Logout button -->
                            
                        </div>
                    </div>
                </div>
                <!-- User's Courses Section -->
                <div class="user-courses">
                    <h4>Your Courses</h4>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($courses as $course)
                            <div class="col">
                                <div class="course-item">
                                    <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="img-fluid">
                                    <h5>{{ $course->title }}</h5>
                                    <!-- <p>{{ $course->description }}</p> -->
                                    <div class="course-price">${{ $course->price }}</div>
                                    <div class="course-rating">Rating: {{ $course->rating }}</div>
                                    
                                    <!-- Edit and Delete Buttons -->
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="username"
                                value="{{ $user->username }}">
                        </div>
                        <div class="mb-3">
                            <label for="editGender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="editGender" name="gender"
                                value="{{ $user->gender }}">
                        </div>
                        <div class="mb-3">
                            <label for="editPhoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="editPhoneNumber" name="phone_number"
                                value="{{ $user->phone_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="editProfileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="editProfileImage" name="profile_image">
                        </div>
                        <button type="button" class="btn btn-primary" id="saveProfileButton">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- AJAX script to update profile -->
    <script>
        document.getElementById('editProfileButton').addEventListener('click', function () {
            var modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
            modal.show();
        });

        document.getElementById('saveProfileButton').addEventListener('click', function () {
            var form = document.getElementById('editProfileForm');
            var formData = new FormData(form);

            fetch('{{ route('profile.update') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update profile details on the page
                        document.getElementById('username').innerText = formData.get('username');
                        document.getElementById('gender').innerText = formData.get('gender');
                        document.getElementById('phone_number').innerText = formData.get('phone_number');
                        
                        // Update profile image if changed
                        if (formData.get('profile_image').size > 0) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('profileImage').src = e.target.result;
                            }
                            reader.readAsDataURL(formData.get('profile_image'));
                        }
                        
                        // Hide the modal
                        var modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
                        modal.hide();
                        
                        // Show success message (consider using a toast or similar)
                        alert('Profile updated successfully!');
                    } else {
                        // Show error message (consider improving error handling)
                        alert('An error occurred. Please try again.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
