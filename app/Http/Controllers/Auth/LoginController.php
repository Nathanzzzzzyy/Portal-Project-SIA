<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showStudent()
    {
        return view('auth.login');
    }

    public function showAdmin()
    {
        return view('auth.admin-login');
    }

    public function student(Request $request)
    {
        return $this->attempt($request, 'student', 'login');
    }

    public function admin(Request $request)
    {
        return $this->attempt($request, 'admin', 'admin.login');
    }

    private function attempt(Request $request, string $role, string $backRoute)
    {
        $field = $role === 'admin' ? 'username' : 'login';

        $request->validate([
            $field => ['required', 'string'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => config('recaptcha.enabled') ? ['required', new Recaptcha] : [],
        ], [
            'g-recaptcha-response.required' => 'Please tick "I\'m not a robot".',
        ]);

        // Students may log in with email OR student number; admins with username OR email.
        $value = $request->input($field);
        $column = filter_var($value, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : ($role === 'admin' ? 'username' : 'student_number');

        $credentials = [$column => $value, 'password' => $request->password, 'role' => $role, 'status' => 'active'];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->route($backRoute)
                ->withInput($request->only($field))
                ->withErrors([$field => 'These credentials do not match our records (or the account is inactive).']);
        }

        $request->session()->regenerate();

        return redirect()->intended($role === 'admin' ? route('admin.dashboard') : route('student.dashboard'));
    }

    public function logout(Request $request)
    {
        $wasAdmin = $request->user()?->isAdmin();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($wasAdmin ? 'admin.login' : 'login')->with('status', 'You have been logged out.');
    }
}