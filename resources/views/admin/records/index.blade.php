@extends('layouts.app')
@section('title', 'Student Records')

@section('content')
<form class="toolbar" method="GET">
    <input class="grow" name="q" value="{{ request('q') }}" placeholder="Search student name or number...">
    <button class="btn ghost">Search</button>
</form>
<div class="card">
    <div class="table-wrap"><table class="tbl">
        <tr><th>Student No.</th><th>Name</th><th>Course</th><th>Subjects</th><th>GPA</th><th></th></tr>
        @foreach ($students as $s)
            <tr>
                <td>{{ $s->student_number }}</td><td>{{ $s->name }}</td><td>{{ $s->course }}</td>
                <td>{{ $s->enrollments_count }}</td><td>{{ $s->gpa() ?? '—' }}</td>
                <td><a class="btn sm" href="{{ route('admin.records.show', $s) }}">Open record</a></td>
            </tr>
        @endforeach
    </table></div>
    {{ $students->links() }}
</div>
@endsection