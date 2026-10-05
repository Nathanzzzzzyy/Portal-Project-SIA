@extends('layouts.guest')
@section('title', 'Login')

@section('brand')
    <p class="tag">Building Lives, Shaping the Future</p>
@endsection

@section('content')
    <h2>Welcome Back!</h2>
    <p class="sub">Log in to your University Portal</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label>Email or Student Number</label>
            <input type="text" name="login" value="{{ old('login') }}" placeholder="nathanmabag@uc.edu.ph or 2026-0000" required autofocus>
            @error('login') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            @error('password') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="between">
            <label class="check"><input type="checkbox" name="remember"> Remember Me</label>
            <a href="#" onclick="alert('Please contact the Registrar or an administrator to reset your password.');return false">Forgot Password?</a>
        </div>

        @if (config('recaptcha.enabled'))
            <div class="captcha"><div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div></div>
            @error('g-recaptcha-response') <div class="err" style="text-align:center">{{ $message }}</div> @enderror
        @endif

        <button class="btn block" type="submit">Login</button>
    </form>

    <p class="foot">Don't have an account? <a href="{{ route('register') }}"><b>Register here</b></a><br>
        <a href="{{ route('admin.login') }}" style="font-size:12px">Administrator login</a></p>
@endsection