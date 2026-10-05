@extends('layouts.app')
@section('title', 'Admin Dashboard')

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
@endpush

@section('content')
    <div class="stats">
        <div class="stat"><div class="ico g">&#127891;</div><div><small>Total Students</small><b>{{ number_format($totalStudents) }}</b></div></div>
        <div class="stat"><div class="ico y">&#128100;</div><div><small>Total Admins</small><b>{{ $totalAdmins }}</b></div></div>
        <div class="stat"><div class="ico b">&#128214;</div><div><small>Total Subjects</small><b>{{ $totalSubjects }}</b></div></div>
        <div class="stat"><div class="ico p">&#10024;</div><div><small>New Registrations</small><b>{{ $newThisMonth }}</b></div></div>
    </div>

    <div class="grid2">
        <div class="card">
            <h3>Enrollment Overview ({{ now()->year }})</h3>
            <canvas id="chart" height="150"></canvas>
        </div>
        <div class="card">
            <h3>Recent Registrations <a href="{{ route('admin.users.index') }}">View All</a></h3>
            <div class="table-wrap"><table class="tbl">
                <tr><th>Name</th><th>Course</th><th>Date</th></tr>
                @foreach ($recent as $u)
                    <tr><td>{{ $u->name }}</td><td>{{ $u->course }}</td><td>{{ $u->created_at->format('M d, Y') }}</td></tr>
                @endforeach
            </table></div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    new Chart(document.getElementById('chart'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{ label: 'New students', data: @json($chart), borderColor: '#14753f', backgroundColor: 'rgba(20,117,63,.15)', fill: true, tension: .35, pointBackgroundColor: '#14753f' }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });
</script>
@endpush