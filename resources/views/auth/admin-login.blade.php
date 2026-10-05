@extends('layouts.guest')
@section('title', 'Administrator Login')

@section('brand')
    <p class="tag">Administrative Portal</p>
@endsection

@section('content')
    <h2>Administrator Login</h2>
    <p class="sub">Access the admin panel</p>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="field">
            <label>Username or Email</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="admin" required autofocus>
            @error('username') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <div class="err">{{ $message }}</div> @enderror
        </div>
        <label class="check" style="margin-bottom:14px"><input type="checkbox" name="remember"> Remember Me</label>

        @if (config('recaptcha.enabled'))
            <div class="captcha"><div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div></div>
            @error('g-recaptcha-response') <div class="err" style="text-align:center">{{ $message }}</div> @enderror
        @endif

        <button class="btn block" type="submit">Login</button>
    </form>
    <p class="foot"><a href="{{ route('login') }}">Back to Portal</a></p>
@endsection