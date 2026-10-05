<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class StudentController extends Controller
{
    public const SEMESTER = '1st Semester 2025 - 2026';

    /** /dashboard sends each role to the right place */
    public function redirect(Request $request)
    {
        return $request->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('student.dashboard');
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $enrollments = $user->enrollments()->with('subject')->where('semester', self::SEMESTER)->get();

        return view('student.dashboard', [
            'user' => $user,
            'enrollments' => $enrollments,
            'units' => $enrollments->sum(fn ($e) => $e->subject->units),
            'gpa' => $user->gpa(),
            'announcements' => Announcement::published()->take(4)->get(),
        ]);
    }

    public function profile(Request $request)
    {
        return view('student.profile', ['user' => $request->user(), 'editing' => $request->boolean('edit')]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:Male,Female,Other'],
            'address' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ]);
        $request->user()->update($data);

        return redirect()->route('student.profile')->with('status', 'Profile updated.');
    }

    public function enrollment(Request $request)
    {
        $user = $request->user();
        $enrolledIds = $user->enrollments()->where('semester', self::SEMESTER)->pluck('subject_id');

        return view('student.enrollment', [
            'enrolled' => Subject::whereIn('id', $enrolledIds)->get(),
            'available' => Subject::whereNotIn('id', $enrolledIds)->orderBy('code')->get(),
            'semester' => self::SEMESTER,
        ]);
    }

    public function enroll(Request $request, Subject $subject)
    {
        Enrollment::firstOrCreate([
            'user_id' => $request->user()->id, 'subject_id' => $subject->id, 'semester' => self::SEMESTER,
        ]);

        return back()->with('status', "Enrolled in {$subject->code}.");
    }

    public function drop(Request $request, Subject $subject)
    {
        $request->user()->enrollments()
            ->where('subject_id', $subject->id)->where('semester', self::SEMESTER)->whereNull('grade')->delete();

        return back()->with('status', "Dropped {$subject->code} (graded subjects cannot be dropped).");
    }

    public function subjects(Request $request)
    {
        return view('student.subjects', [
            'enrollments' => $request->user()->enrollments()->with('subject')->get(),
        ]);
    }

    public function grades(Request $request)
    {
        $user = $request->user();

        return view('student.grades', [
            'enrollments' => $user->enrollments()->with('subject')->whereNotNull('grade')->get(),
            'gpa' => $user->gpa(),
            'semester' => self::SEMESTER,
        ]);
    }

    public function schedule(Request $request)
    {
        return view('student.schedule', [
            'enrollments' => $request->user()->enrollments()->with('subject')->where('semester', self::SEMESTER)->get(),
        ]);
    }

    public function announcements()
    {
        return view('student.announcements', ['announcements' => Announcement::published()->paginate(8)]);
    }

    public function settings()
    {
        return view('student.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);
        $request->user()->update(['password' => $request->password]);

        return back()->with('status', 'Password changed successfully.');
    }
}