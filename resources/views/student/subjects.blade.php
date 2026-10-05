@extends('layouts.app')
@section('title', 'Subjects')

@section('content')
<div class="card">
    <div class="table-wrap"><table class="tbl">
        <tr><th>Code</th><th>Title</th><th>Units</th><th>Semester</th><th>Status</th></tr>
        @forelse ($enrollments as $e)
            <tr>
                <td>{{ $e->subject->code }}</td><td>{{ $e->subject->title }}</td><td>{{ $e->subject->units }}</td>
                <td>{{ $e->semester }}</td>
                <td>@if ($e->grade) <span class="badge">Graded</span> @else <span class="badge warn">Ongoing</span> @endif</td>
            </tr>
        @empty
            <tr><td colspan="5" style="color:var(--muted)">No subjects yet.</td></tr>
        @endforelse
    </table></div>
</div>
@endsection