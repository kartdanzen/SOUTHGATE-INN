<a href="{{ route('index') }}" class="logo-container">
    <img src="{{ asset('images/H3.png') }}" alt="Southgate Inn Logo" class="logo-image">
</a>
<nav class="nav">
    <a href="{{ route('index') }}" class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
        <i class="fas fa-home"></i>HOME
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('index'))<span class="underline"></span>@endif
    </a>
    <a href="{{ route('blog') }}" class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}">
        <i class="fas fa-blog"></i>BLOG
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('blog'))<span class="underline"></span>@endif
    </a>
    <a href="{{ route('room') }}" class="nav-item {{ request()->routeIs('room') ? 'active' : '' }}">
        <i class="fas fa-bed"></i>ROOM
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('room'))<span class="underline"></span>@endif
    </a>
    <a href="{{ route('gallerys') }}" class="nav-item {{ request()->routeIs('gallerys') ? 'active' : '' }}">
        <i class="fas fa-images"></i>GALLERY
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('gallerys'))<span class="underline"></span>@endif
    </a>
    <a href="{{ route('reviews') }}" class="nav-item {{ request()->routeIs('reviews') ? 'active' : '' }}">
        <i class="fas fa-star"></i>REVIEWS
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('reviews'))<span class="underline"></span>@endif
    </a>
    <a href="{{ route('event') }}" class="nav-item {{ request()->routeIs('event') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt"></i>EVENTS
        <span class="hover-bg"></span>
        <span class="ripple"></span>
        @if(request()->routeIs('event'))<span class="underline"></span>@endif
    </a>
</nav>
<button class="menu-toggle" aria-label="Toggle menu">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
</button>
<div class="menu-overlay"></div>
