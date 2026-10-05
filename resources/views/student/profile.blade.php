@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="card" style="max-width:720px">
    <div class="profile-head">
        <div class="avatar">{{ $user->initials() }}</div>
        <h3 style="justify-content:center;margin:0">{{ $user->name }}</h3>
        <small style="color:var(--muted)">{{ $user->course }} - {{ $user->year_level }}<br>Student Number: {{ $user->student_number }}</small>
    </div>

    @if (! $editing)
        <dl class="kv">
            <dt>Full Name</dt><dd>{{ $user->name }}</dd>
            <dt>Email</dt><dd>{{ $user->email }} <span class="badge">verified</span></dd>
            <dt>Birthdate</dt><dd>{{ $user->birthdate?->format('F d, Y') ?? '—' }}</dd>
            <dt>Gender</dt><dd>{{ $user->gender ?? '—' }}</dd>
            <dt>Address</dt><dd>{{ $user->address ?? '—' }}</dd>
            <dt>Contact Number</dt><dd>{{ $user->contact_number ?? '—' }}</dd>
        </dl>
        <div style="text-align:center;margin-top:22px"><a class="btn" href="{{ route('student.profile', ['edit' => 1]) }}">Edit Profile</a></div>
    @else
        <form method="POST" action="{{ route('student.profile.update') }}">
            @csrf @method('PUT')
            <div class="field"><label>Full Name</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
            <div class="row">
                <div class="field"><label>Birthdate</label><input type="date" name="birthdate" value="{{ old('birthdate', $user->birthdate?->format('Y-m-d')) }}"></div>
                <div class="field"><label>Gender</label>
                    <select name="gender">
                        <option value="">-</option>
                        @foreach (['Male', 'Female', 'Other'] as $g) <option @selected(old('gender', $user->gender) === $g)>{{ $g }}</option> @endforeach
                    </select>
                </div>
            </div>
            <div class="field"><label>Address</label><input name="address" value="{{ old('address', $user->address) }}"></div>
            <div class="field"><label>Contact Number</label><input name="contact_number" value="{{ old('contact_number', $user->contact_number) }}"></div>
            <button class="btn" type="submit">Save changes</button>
            <a class="btn ghost" href="{{ route('student.profile') }}">Cancel</a>
        </form>
    @endif
</div>
@endsection