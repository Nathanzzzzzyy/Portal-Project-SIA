@extends('layouts.guest')
@section('title', 'Verify Email')

@section('brand')
    <p class="tag">One last step, Cordilleran!</p>
@endsection

@section('content')
    <h2>Verify your email</h2>
    <p class="sub">We sent a verification link to <b>{{ auth()->user()->email }}</b>. Click it to activate your student portal.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn block" type="submit">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:10px">
        @csrf
        <button class="btn ghost block" type="submit">Log out</button>
    </form>
    <p class="foot">Didn't get it? Check your spam folder.</p>
@endsection