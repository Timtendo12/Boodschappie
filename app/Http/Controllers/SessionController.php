<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\LoginRequest;
use App\Http\Requests\Session\RegisterRequest;
use App\Http\Requests\Session\ResendVerificationEmailRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Traits\CommonTrait;

class SessionController extends Controller
{
    use CommonTrait;

    public function login()
    {
        return Inertia::render('session/login');
    }

    public function store(LoginRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $password = $validated['password'];
        $remember = $validated['remember'];

        $user = User::where('email', $email)
            ->where('email_verified_at', '!=', null)
            ->where('verify_token', '=', null)
            ->where('auth_session', '=', null)
            ->first();

        if (!$user) {
            return $this->CommonResponse(null, 'User not found', 404);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return $this->CommonResponse(null, 'Invalid credentials', 400);
        }

        Auth()->login($user, $remember);

        return redirect('/app')->with('success', 'Je bent ingelogd. Welkom terug!')->with('confetti', true);
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
            return $this->CommonResponse(null, 'User already exists', 400, false);
        }

        $token = $this->createVerificationCode();
        $authSession = $this->createAuthSession();

        $user = User::create([
            'first_name' => ucwords($firstName),
            'last_name' => ucwords($lastName),
            'email' => $email,
            'password' => bcrypt($password),
            'verify_token' => $token,
            'auth_session' => $authSession,
        ]);

        // send verification email
        //TODO: Uncomment this $user->sendVerifyEmailNotification($token);

        return $this->CommonResponse($user, 'User created successfully', 201, true);
    }

    public function register()
    {
        return Inertia::render('session/register');
    }

    public function destroy()
    {
        Auth::logout();

        return $this->CommonResponse(null, 'User logged out', 200);
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
        $user->auth_session = null;
        $saveAction = $user->save();
        if (!$saveAction) {
            //BS-0001: Gebruiker kon niet opgeslagen worden.
            return $this->CommonResponse(null, 'Er is een fout opgetreden: BS-0001', 400);
        }

        return redirect('/')->with('success', 'Je e-mailadres is geverifieerd. Je kan nu inloggen.')->with('confetti', true);
    }

    public function resendVerificationEmail(ResendVerificationEmailRequest $request) {
        $validated = $request->validated();
        $email = $validated['email'];
        $session = $validated['session'];

        $user = User::where('email', $email)->where('auth_session', $session)->first();

        if (!$user) {
            return $this->CommonResponse(null, 'User not found', 404);
        }

        $token = $this->createVerificationCode();
        $user->verify_token = $token;
        $saveAction = $user->save();

        if (!$saveAction) {
            //BS-0001: Gebruiker kon niet opgeslagen worden.
            return $this->CommonResponse(null, 'Er is een fout opgetreden: BS-0001', 400);
        }

        // send verification email
        $user->sendVerifyEmailNotification($token);

        return $this->CommonResponse(null, 'Verification email sent', 200);
    }

    public function createVerificationCode(): string {
        // generate a random string of length 32
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    }

    public function createAuthSession(): string {
        // generate a random string of length 32
        return "AUTH-" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 64);
    }
}
