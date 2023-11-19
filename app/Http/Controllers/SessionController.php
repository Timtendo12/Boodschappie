<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Traits\CommonTrait;

class SessionController extends Controller
{
    use CommonTrait;
    public function store()
    {
        return Inertia::render('app');
    }

    public function login()
    {
        return Inertia::render('session/login');
    }

    public function create(RegisterRequest $request)
    {
        $validatedRequest = $request->validated();

        $firstName = $validatedRequest['firstName'];
        $lastName = $validatedRequest['lastName'];
        $email = $validatedRequest['email'];
        $password = $validatedRequest['password'];

        $user = User::where('email', $email)->first();

        if ($user) {
            return $this->CommonResponse(null, 'User already exists', 400);
        }

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => $this->createVerificationCode(),
        ]);

        return $this->CommonResponse($user, 'User created successfully', 201);
    }

    public function register()
    {
        return Inertia::render('session/register');
    }

    public function destroy()
    {
        return Inertia::render('app');
    }

    public function verifyEmail()
    {
        $token = request()->get('c');

        if (!$token) {
            return redirect('/');
        }

        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return redirect('/')->with('error', 'BS:0002: Deze verificatie link is niet (meer) geldig.');
        }

        $user->email_verified_at = now();
        $user->verify_token = null;
        $saveAction = $user->save();
        if (!$saveAction) {
            //BS-0001: Gebruiker kon niet opgeslagen worden.
            return $this->CommonResponse(null, 'Er is een fout opgetreden: BS-0001', 400);
        }

        return redirect('/')->with('success', 'Je e-mailadres is geverifieerd. Je kan nu inloggen.');
    }

    public function createVerificationCode(): string {
        // generate a random string of length 32
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    }
}
