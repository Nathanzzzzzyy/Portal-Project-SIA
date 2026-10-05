@extends('layouts.app')
@section('title', 'Settings')

@section('content')
<div class="card" style="max-width:520px">
    <h3>Change Password</h3>
    <form method="POST" action="{{ route('student.password') }}">
        @csrf @method('PUT')
        <div class="field"><label>Current Password</label><input type="password" name="current_password" required></div>
        <div class="field"><label>New Password</label><input type="password" name="password" required></div>
        <div class="field"><label>Confirm New Password</label><input type="password" name="password_confirmation" required></div>
        <button class="btn">Update password</button>
    </form>
</div>
@endsection