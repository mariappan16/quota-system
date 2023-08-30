<!DOCTYPE html>
<html>
<head>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
<div class="main-container">
    <nav>
        <ul>
            {{-- <li><a href="/">Home</a></li>
            <li><a href="{{ route('sports.index') }}">Sports</a></li>
            <li><a href="{{ route('genders.index') }}">Genders</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li> --}}
            <li><a href="{{ route('overall-quotas.create') }}">Create Overall Quota</a></li>
            <li><a href="{{ route('state-quotas.create') }}">Create State Quota</a></li>
        </ul>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</div>

<!-- Add your scripts and other body elements here -->
</body>
</html>
