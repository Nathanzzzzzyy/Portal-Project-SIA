<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        // registrations per month for the chart (current year, PHP-side so it works on MySQL & SQLite)
        $perMonth = array_fill(1, 12, 0);
        User::where('role', 'student')->whereYear('created_at', now()->year)->get(['created_at'])
            ->each(fn ($u) => $perMonth[(int) $u->created_at->format('n')]++);

        return view('admin.dashboard', [
            'totalStudents' => User::where('role', 'student')->count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalSubjects' => Subject::count(),
            'newThisMonth' => User::where('role', 'student')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'recent' => User::where('role', 'student')->latest()->take(5)->get(),
            'chart' => array_values($perMonth),
        ]);
    }

    public function settings()
    {
        return view('admin.settings', ['subjects' => Subject::orderBy('code')->get()]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);
        $request->user()->update(['password' => $request->password]);

        return back()->with('status', 'Password changed.');
    }
}