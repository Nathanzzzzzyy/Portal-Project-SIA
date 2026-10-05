@extends('layouts.app')
@section('title', $item->exists ? 'Edit Announcement' : 'Add Announcement')

@section('content')
<div class="card" style="max-width:640px">
    <form method="POST" action="{{ $item->exists ? route('admin.announcements.update', $item) : route('admin.announcements.store') }}">
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="field"><label>Title</label><input name="title" value="{{ old('title', $item->title) }}" required></div>
        <div class="field"><label>Content</label><textarea name="content" rows="6" required>{{ old('content', $item->content) }}</textarea></div>
        <div class="field"><label>Status</label>
            <select name="status"><option value="published" @selected(old('status', $item->status) === 'published')>Published</option><option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option></select>
        </div>
        <button class="btn">Save</button>
        <a class="btn ghost" href="{{ route('admin.announcements.index') }}">Cancel</a>
    </form>
</div>
@endsection