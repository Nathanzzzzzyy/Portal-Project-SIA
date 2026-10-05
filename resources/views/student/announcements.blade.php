@extends('layouts.app')
@section('title', 'Announcements')

@section('content')
@forelse ($announcements as $a)
    <div class="card">
        <h3>{{ $a->title }} <small style="color:var(--muted);font-weight:400">{{ $a->published_at?->format('F d, Y') }}</small></h3>
        <p>{{ $a->content }}</p>
    </div>
@empty
    <p style="color:var(--muted)">No announcements yet.</p>
@endforelse
{{ $announcements->links() }}
@endsection