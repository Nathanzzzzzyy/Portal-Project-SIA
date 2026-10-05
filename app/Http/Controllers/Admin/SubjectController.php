<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        Subject::create($request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:subjects,code'],
            'title' => ['required', 'string', 'max:255'],
            'units' => ['required', 'integer', 'between:1,6'],
            'schedule_day' => ['nullable', 'string', 'max:20'],
            'schedule_time' => ['nullable', 'string', 'max:30'],
            'room' => ['nullable', 'string', 'max:30'],
        ]));

        return back()->with('status', 'Subject added.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back()->with('status', 'Subject deleted.');
    }
}