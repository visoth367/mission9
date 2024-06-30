<header class="header">
    <div class="container">
        <div class="header-left">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('Image/Logo.png') }}" alt="Educator Logo">
            </a>
            <nav>
                <ul>
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/courses') }}">Courses</a></li>
                    <li><a href="{{ url('/about-us') }}">About</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                </ul>
            </nav>
            <div class="search-container">
                <input type="text" placeholder="What do you want to learn?">
                <button><img src="{{ asset('Image/search.png') }}" alt="Search"></button>
            </div>
        </div>
        <div class="header-right">
        @if(Auth::check())
            <a href="{{ route('profile.show') }}" class="profile-link">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile Image">
                @else
                    <img src="{{ asset('path/to/default/profile/image.jpg') }}" alt="Default Profile Image">
                @endif
                <div class="profile-name">
                    {{ Auth::user()->username }}
                </div>
            </a>
            
        @else
            <a href="{{ url('/Sign_up') }}" class="btn btn-create-account">Create Account</a>
            <a href="{{ url('/login') }}" class="btn btn-sign-in">Sign In</a>
        @endif
        </div>
    </div>
</header>
