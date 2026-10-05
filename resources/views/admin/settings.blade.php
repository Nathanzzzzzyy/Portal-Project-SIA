@extends('layouts.app')
@section('title', 'Settings')

@section('content')
<div class="grid2">
    <div class="card">
        <h3>Subjects ({{ $subjects->count() }})</h3>
        <form method="POST" action="{{ route('admin.subjects.store') }}" style="margin-bottom:16px">
            @csrf
            <div class="row">
                <div class="field"><label>Code</label><input name="code" required></div>
                <div class="field"><label>Units</label><input type="number" name="units" value="3" min="1" max="6" required></div>
            </div>
            <div class="field"><label>Title</label><input name="title" required></div>
            <div class="row">
                <div class="field"><label>Days</label><input name="schedule_day" placeholder="MWF"></div>
                <div class="field"><label>Time</label><input name="schedule_time" placeholder="8:00 - 9:00 AM"></div>
            </div>
            <div class="field"><label>Room</label><input name="room"></div>
            <button class="btn sm">Add subject</button>
        </form>
        <div class="table-wrap"><table class="tbl">
            @foreach ($subjects as $s)
                <tr><td>{{ $s->code }}</td><td>{{ $s->title }}</td><td>{{ $s->units }}u</td>
                    <td><form method="POST" action="{{ route('admin.subjects.destroy', $s) }}" onsubmit="return confirm('Delete {{ $s->code }}?')">@csrf @method('DELETE')<button class="btn danger sm">x</button></form></td></tr>
            @endforeach
        </table></div>
    </div>

    <div class="card">
        <h3>Change Password</h3>
        <form method="POST" action="{{ route('admin.password') }}">
            @csrf @method('PUT')
            <div class="field"><label>Current Password</label><input type="password" name="current_password" required></div>
            <div class="field"><label>New Password</label><input type="password" name="password" required></div>
            <div class="field"><label>Confirm New Password</label><input type="password" name="password_confirmation" required></div>
            <button class="btn">Update password</button>
        </form>
    </div>
</div>
@endsection