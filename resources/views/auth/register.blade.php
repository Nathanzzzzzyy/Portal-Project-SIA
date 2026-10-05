@extends('layouts.guest')
@section('title', 'Create Account')

@section('brand')
    <p class="tag">Join the UC Community</p>
    <p style="text-transform:none;letter-spacing:0;color:#e9f3ec;margin-top:8px">Create your account to access your academic journey.</p>
@endsection

@section('content')
    <h2>Create Account</h2>
    <p class="sub">We'll email you a link to verify your address.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
            @error('name') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="field">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
            @error('email') <div class="err">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="field">
                <label>Student Number</label>
                <input type="text" value="Auto-generated" disabled style="background:#f1f5f2;color:#6b7a72">
            </div>
            <div class="field">
                <label>Course</label>
                <select name="course" required>
                    <option value="">Select...</option>
                    @foreach ($courses as $c)
                        <option value="{{ $c }}" @selected(old('course') === $c)>{{ $c }}</option>
                    @endforeach
                </select>
                @error('course') <div class="err">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min. 8 chars, letters + numbers" required>
                @error('password') <div class="err">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            </div>
        </div>

        @if (config('recaptcha.enabled'))
            <div class="captcha"><div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div></div>
            @error('g-recaptcha-response') <div class="err" style="text-align:center">{{ $message }}</div> @enderror
        @endif

        <button class="btn block" type="submit">Register</button>
    </form>

    <p class="foot">Already have an account? <a href="{{ route('login') }}"><b>Login here</b></a></p>
@endsection