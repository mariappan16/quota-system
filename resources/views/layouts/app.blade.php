<!DOCTYPE html>
<html>
<head>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="loader" class="loader" style="display: none;"></div>
<div class="main-container">

    <nav>
        <ul>
         
            <li><a href="{{ route('state-quotas.index') }}">State Quota's List</a></li>
            <li><a href="{{ route('overall-quotas.index') }}">Overall Quota's List</a></li>
            <li><a href="{{ route('overall-quotas.create') }}">Create Overall Quota</a></li>
            <li><a href="{{ route('state-quotas.create') }}">Create State Quota</a></li>
        </ul>
    </nav>
    
    <div class="container">
        @yield('content')
    </div>
</div>

<script>
    const currentPath = window.location.href;
    const navLinks = document.querySelectorAll('.main-container nav ul li a'); 

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active'); 
        }
    });
</script>
</body>
</html>


