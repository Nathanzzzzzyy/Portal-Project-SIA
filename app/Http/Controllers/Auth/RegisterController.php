<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public const COURSES = ['BSIT', 'BSCS', 'BSBA', 'BSHM', 'BEED', 'BSED', 'BSN', 'BSCE'];

    public function show()
    {
        return view('auth.register', ['courses' => self::COURSES]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'student_number' => ['required', 'string', 'max:30', 'unique:users,student_number'],
            'course' => ['required', 'in:'.implode(',', self::COURSES)],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'g-recaptcha-response' => config('recaptcha.enabled') ? ['required', new Recaptcha] : [],
        ], [
            'g-recaptcha-response.required' => 'Please tick "I\'m not a robot".',
        ]);

                // the Student Number is generated automatically (see User::nextStudentNumber)
        $user = User::createStudent([
            'name' => $data['name'],
            'email' => $data['email'],
            'course' => $data['course'],
            'year_level' => '1st Year',
            'password' => $data['password'], // hashed by model cast
        ]);

        event(new Registered($user)); // <- sends the verification email
        Auth::login($user);

        return redirect()->route('verification.notice')
            ->with('status', "Account created! Your Student Number is {$user->student_number}. Please verify your email.");
    }
}