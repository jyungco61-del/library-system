<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private const MAX_ATTEMPTS = 5;     
    private const LOCK_SECONDS = 300;  

    public function showLogin()
    {
        return view('auth.auth', ['mode' => 'login']);
    }

    public function showRegister()
    {
        return view('auth.auth', ['mode' => 'register']);
    }

    public function register(Request $request)
    {
        $data = $request->validateWithBag('register', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('books.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validateWithBag('login', [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $key = Str::lower($credentials['email']) . '|' . $request->ip();

        
        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($key);
            return $this->loginError("Too many failed attempts. Try again in {$seconds} seconds.");
        }

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            return redirect()->route('books.index');
        }

        RateLimiter::hit($key, self::LOCK_SECONDS);
        $left = max(self::MAX_ATTEMPTS - RateLimiter::attempts($key), 0);

        if ($left === 0) {
            return $this->loginError('Too many failed attempts. Your account is locked for 5 minutes.');
        }

        return $this->loginError("Wrong email or password. {$left} attempt(s) left.");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function loginError(string $message)
    {
        return redirect()->route('login')
            ->withErrors(['email' => $message], 'login')
            ->onlyInput('email');
    }
}