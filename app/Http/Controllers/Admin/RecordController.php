<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'student')
            ->when($request->q, fn ($q, $s) => $q->where(fn ($w) => $w->where('name', 'like', "%$s%")->orWhere('student_number', 'like', "%$s%")))
            ->withCount('enrollments')->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.records.index', compact('students'));
    }

    public function show(User $user)
    {
        abort_if($user->isAdmin(), 404);

        return view('admin.records.show', [
            'student' => $user,
            'enrollments' => $user->enrollments()->with('subject')->get(),
        ]);
    }

    public function grade(Request $request, Enrollment $enrollment)
    {
        $data = $request->validate(['grade' => ['nullable', 'numeric', 'between:1,5']]);
        $enrollment->update(['grade' => $data['grade'] ?? null]);

        return back()->with('status', 'Grade saved.');
    }
}