<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Open Library' }} · Open Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/readability.css') }}">
    <link rel="stylesheet" href="{{ asset('css/minimum-text.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5.5c3.2-.9 5.9-.4 8 1.4v12c-2.1-1.8-4.8-2.3-8-1.4v-12Zm16 0c-3.2-.9-5.9-.4-8 1.4v12c2.1-1.8 4.8-2.3 8-1.4v-12Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 7v12" stroke="currentColor" stroke-width="1.7"/></svg></span><span>open<span class="brand-light">library</span></span></a>
        <div class="side-label">DISCOVER</div>
        <nav class="side-nav">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><span class="nav-icon">⌂</span> Home</a>
            <a class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}"><span class="nav-icon">⌕</span> Browse catalog</a>
            <a class="nav-link" href="{{ route('catalog', ['category' => 'Books']) }}"><span class="nav-icon">▤</span> Books & eBooks</a>
            <a class="nav-link" href="{{ route('catalog', ['category' => 'Research']) }}"><span class="nav-icon">⌘</span> Research</a>
            <a class="nav-link" href="{{ route('catalog', ['category' => 'Digital media']) }}"><span class="nav-icon">▷</span> Digital media</a>
        </nav>
        <div class="side-label side-label-spaced">YOUR LIBRARY</div>
        <nav class="side-nav">
            <a class="nav-link" href="{{ route('login') }}"><span class="nav-icon">♡</span> Saved items</a>
            <a class="nav-link" href="{{ route('login') }}"><span class="nav-icon">◷</span> Reading history</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="help-card"><span class="help-spark">✳</span><strong>Need a hand?</strong><p>Our library team is happy to help you find your next favorite.</p><a href="mailto:hello@openlibrary.test">Talk to a librarian <span>↗</span></a></div>
            @auth
                <div class="profile-mini"><span class="avatar avatar-soft">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span><span><strong>{{ Auth::user()->name }}</strong><small>Library member</small></span></div>
            @else
                <a class="profile-mini" href="{{ route('login') }}"><span class="avatar avatar-soft">G</span><span><strong>Guest account</strong><small>Sign in to get more</small></span><span class="chevron">⌄</span></a>
            @endauth
        </div>
    </aside>
    <main class="main-area">
        <header class="topbar"><div class="breadcrumbs"><span>Library</span><span class="crumb-slash">/</span><strong>{{ $section ?? 'Home' }}</strong></div><div class="top-actions"><button class="icon-button notification" aria-label="Notifications">♧<i></i></button>@auth<span class="welcome-user">Hi, {{ Auth::user()->name }}</span><form action="{{ route('logout') }}" method="POST" class="logout-form">@csrf<button class="button button-primary button-small" type="submit">Sign out</button></form>@else @if(request()->routeIs('login'))<a class="button button-primary button-small" href="{{ route('register') }}">Create account <span>→</span></a>@elseif(request()->routeIs('register'))<a class="signin-link" href="{{ route('login') }}">Sign in</a>@else<a class="signin-link" href="{{ route('login') }}">Sign in</a><a class="button button-primary button-small" href="{{ route('register') }}">Create account <span>→</span></a>@endif @endauth<button class="mobile-menu" aria-label="Open menu">☰</button></div></header>
        <div class="page-content">
            @if(session('status'))<div class="auth-success" role="status">{{ session('status') }}</div>@endif
            @yield('content')
        </div>
        <footer class="site-footer"><span>© 2024 Open Library</span><span><a href="#">About</a><a href="#">Help center</a><a href="#">Accessibility</a></span></footer>
    </main>
</div>
<script src="{{ asset('js/library.js') }}" defer></script>
</body>
</html>
