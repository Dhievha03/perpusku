<nav class="navbar navbar-expand-md navbar-light fixed-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <h3>Perpusku</h3> 
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
            </ul>
            <div>
                @if (Auth::check())
                <a href="{{ route('user.dashboard') }}" class="text-white text-decoration-none px-4 py-2 rounded-5 fw-bold bg-app-primary">Dashboard</a>
                @else
                <a href="{{ route('user.login') }}" class="text-white text-decoration-none px-4 py-2 rounded-5 bg-app-primary">Login</a>
                <a href="{{ route('user.register') }}"
                    class="text-blue text-decoration-none px-4 py-2 rounded-5 border border-primary">Sign Up</a>
                @endif
               
            </div>
        </div>
    </div>
</nav>
