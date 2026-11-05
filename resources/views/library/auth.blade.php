@extends('library.layout', ['title' => $mode === 'login' ? 'Sign in' : 'Create account', 'section' => $mode === 'login' ? 'Sign in' : 'Create account'])
@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-art"><div class="auth-orbit"></div><div class="auth-art-book">✦</div><span class="auth-float float-a">✳</span><span class="auth-float float-b">✦</span></div>
        <div class="auth-content">
            <div class="eyebrow"><span class="eyebrow-dot"></span> WELCOME TO OPEN LIBRARY</div>
            <h1>{{ $mode === 'login' ? 'Good to see you.' : 'Let’s make it yours.' }}</h1>
            <p>{{ $mode === 'login' ? 'Sign in to save your favorites and pick up where you left off.' : 'Create your free account to save titles, place holds, and keep your reading in one place.' }}</p>

            @if($errors->any())
                <div class="auth-error" role="alert">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <form class="auth-form" action="{{ route($mode === 'login' ? 'login.store' : 'register.store') }}" method="POST">
                @csrf
                @if($mode === 'register')
                    <label>Your name<input type="text" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Alex Morgan" required autofocus></label>
                @endif
                <label>Email address<input type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com" required {{ $mode === 'login' ? 'autofocus' : '' }}></label>
                <label>Password<input type="password" name="password" autocomplete="{{ $mode === 'login' ? 'current-password' : 'new-password' }}" placeholder="{{ $mode === 'login' ? 'Your password' : 'At least 8 characters' }}" minlength="{{ $mode === 'register' ? '8' : '1' }}" required></label>
                @if($mode === 'register')
                    <label>Confirm password<input type="password" name="password_confirmation" autocomplete="new-password" placeholder="Enter your password again" minlength="8" required></label>
                @else
                    <label class="remember-choice"><input type="checkbox" name="remember" value="1"> Keep me signed in</label>
                @endif
                <button class="button button-primary auth-submit" type="submit">{{ $mode === 'login' ? 'Sign in' : 'Create account' }} <span>→</span></button>
            </form>
            <div class="auth-switch">{{ $mode === 'login' ? 'New to the library?' : 'Already have an account?' }} <a href="{{ route($mode === 'login' ? 'register' : 'login') }}">{{ $mode === 'login' ? 'Create an account' : 'Sign in' }}</a></div>
        </div>
    </div>
    <a class="back-home" href="{{ route('home') }}">← Back to the library</a>
</div>
@endsection
