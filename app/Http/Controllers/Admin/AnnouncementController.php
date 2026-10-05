<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.announcements.index', ['items' => Announcement::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('admin.announcements.form', ['item' => new Announcement(['status' => 'published'])]);
    }

    public function store(Request $request)
    {
        Announcement::create($this->data($request));

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement created.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.form', ['item' => $announcement]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $announcement->update($this->data($request));

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return back()->with('status', 'Announcement deleted.');
    }

    private function data(Request $request): array
    {
        $d = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:published,draft'],
        ]);
        $d['published_at'] = $d['status'] === 'published' ? now() : null;

        return $d;
    }
}