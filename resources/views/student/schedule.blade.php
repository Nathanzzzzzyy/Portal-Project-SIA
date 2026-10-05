@extends('layouts.app')
@section('title', 'Schedule')

@section('content')
<div class="sched">
    @forelse ($enrollments as $e)
        <div class="slot">
            <span class="badge">{{ $e->subject->schedule_day ?? 'TBA' }}</span>
            <h3 style="margin:8px 0 2px;font-size:15px">{{ $e->subject->code }}</h3>
            <div>{{ $e->subject->title }}</div>
            <small style="color:var(--muted)">{{ $e->subject->schedule_time ?? 'TBA' }} &middot; {{ $e->subject->room ?? 'TBA' }}</small>
        </div>
    @empty
        <p style="color:var(--muted)">Enroll in subjects to see your schedule.</p>
    @endforelse
</div>
@endsection