@extends('layouts.app')
@section('title', 'Student Dashboard')

@section('content')
    <div class="hero">
        <h2>Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 18 ? 'Afternoon' : 'Evening') }}, {{ explode(' ', $user->name)[0] }}!</h2>
        <p>Keep going, your future is within reach.</p>
    </div>

    <div class="stats">
        <div class="stat"><div class="ico g">&#128214;</div><div><small>Enrolled Subjects</small><b>{{ $enrollments->count() }}</b></div></div>
        <div class="stat"><div class="ico y">&#127942;</div><div><small>Current GPA</small><b>{{ $gpa ? number_format($gpa, 2) : '—' }}</b></div></div>
        <div class="stat"><div class="ico b">&#127891;</div><div><small>Total Units</small><b>{{ $units }}</b></div></div>
        <div class="stat"><div class="ico p">&#128197;</div><div><small>Academic Year</small><b style="font-size:17px">2025 - 2026</b></div></div>
    </div>

    <div class="grid2">
        <div class="card">
            <h3>My Subjects <a href="{{ route('student.subjects') }}">View All</a></h3>
            @forelse ($enrollments as $e)
                <div class="list-item">
                    <div class="dot">{{ substr($e->subject->code, 0, 2) }}</div>
                    <div><b>{{ $e->subject->code }}</b> - {{ $e->subject->title }}<small>{{ $e->subject->units }} units</small></div>
                </div>
            @empty
                <p style="color:var(--muted)">No subjects yet. <a href="{{ route('student.enrollment') }}">Enroll now</a>.</p>
            @endforelse
        </div>

        <div class="card">
            <h3>Announcements <a href="{{ route('student.announcements') }}">View All</a></h3>
            @forelse ($announcements as $a)
                <div class="list-item">
                    <div class="dot">&#128226;</div>
                    <div><b>{{ $a->title }}</b><small>{{ $a->published_at?->format('F d, Y') }}</small></div>
                </div>
            @empty
                <p style="color:var(--muted)">No announcements.</p>
            @endforelse
        </div>
    </div>
@endsection