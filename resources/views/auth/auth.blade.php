<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library System | {{ $mode === 'login' ? 'Login' : 'Register' }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #87ceeb 0%, #1e5fa8 55%, #0b2a6f 100%);
        }
        .container {
            position: relative; width: 860px; max-width: 95%; min-height: 540px;
            background: #fff; border-radius: 18px; overflow: hidden;
            box-shadow: 0 20px 50px rgba(5, 20, 70, .45);
        }
        .form-container { position: absolute; top: 0; height: 100%; width: 50%; transition: all .6s ease-in-out; }
        .sign-in-container { left: 0; z-index: 2; }
        .sign-up-container { left: 0; opacity: 0; z-index: 1; }
        .container.right-panel-active .sign-in-container { transform: translateX(100%); }
        .container.right-panel-active .sign-up-container { transform: translateX(100%); opacity: 1; z-index: 5; }

        form { height: 100%; display: flex; flex-direction: column; justify-content: center; padding: 0 40px; }
        h1 { margin: 0 0 6px; color: #0b2a6f; font-size: 28px; }
        .sub { color: #6b7a99; font-size: 14px; margin: 0 0 14px; }
        input {
            width: 100%; padding: 11px 14px; margin: 6px 0; border: 1px solid #d5e3f5;
            background: #eef5fc; border-radius: 8px; font-size: 14px; outline: none;
        }
        input:focus { border-color: #1e5fa8; background: #fff; }
        button {
            margin-top: 12px; padding: 12px; border: 0; border-radius: 25px; cursor: pointer;
            font-weight: 600; letter-spacing: .5px; color: #fff;
            background: linear-gradient(90deg, #3aa0e0, #0b2a6f);
        }
        button:disabled { opacity: .6; cursor: not-allowed; }
        button.ghost { background: transparent; border: 2px solid #fff; margin-top: 18px; padding: 11px 34px; }
        .error { background: #fdeaea; color: #b3261e; padding: 8px 10px; border-radius: 6px; font-size: 13px; margin-bottom: 8px; }

        .overlay-container {
            position: absolute; top: 0; left: 50%; width: 50%; height: 100%;
            overflow: hidden; transition: transform .6s ease-in-out; z-index: 100;
        }
        .container.right-panel-active .overlay-container { transform: translateX(-100%); }
        .overlay {
            position: relative; left: -100%; height: 100%; width: 200%; color: #fff;
            background: linear-gradient(to right, #87ceeb, #1e5fa8 50%, #0b2a6f);
            transform: translateX(0); transition: transform .6s ease-in-out;
        }
        .container.right-panel-active .overlay { transform: translateX(50%); }
        .overlay-panel {
            position: absolute; top: 0; height: 100%; width: 50%; padding: 0 36px; text-align: center;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            transition: transform .6s ease-in-out;
        }
        .overlay-panel h1 { color: #fff; }
        .overlay-panel p { font-size: 14px; line-height: 1.6; }
        .overlay-left { transform: translateX(-20%); }
        .container.right-panel-active .overlay-left { transform: translateX(0); }
        .overlay-right { right: 0; transform: translateX(0); }
        .container.right-panel-active .overlay-right { transform: translateX(20%); }
    </style>
</head>
<body>
    <div class="container {{ $mode === 'register' ? 'right-panel-active' : '' }}" id="container">

        {{-- REGISTER FORM --}}
        <div class="form-container sign-up-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                @formToken
                <h1>Create Account</h1>
                <p class="sub">Register to use the library-system for free</p>

                @if ($errors->register->any())
                    <div class="error">
                        @foreach ($errors->register->all() as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @endif

                <input type="text" name="name" placeholder="Full name" value="{{ $mode === 'register' ? old('name') : '' }}" required>
                <input type="email" name="email" placeholder="Email" value="{{ $mode === 'register' ? old('email') : '' }}" required>
                <input type="password" name="password" placeholder="Password (min 8 characters)" required>
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                <button type="submit">SIGN UP</button>
            </form>
        </div>

        {{-- LOGIN FORM --}}
        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Welcome Back</h1>
                <p class="sub">Login to your account Buddy!</p>

                @if ($errors->login->any())
                    <div class="error">
                        @foreach ($errors->login->all() as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @endif

                <input type="email" name="email" placeholder="Email" value="{{ $mode === 'login' ? old('email') : '' }}" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">LOGIN</button>
            </form>
        </div>

        {{-- SLIDING PANEL --}}
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Already a member?</h1>
                    <p>Login with your account to continue.</p>
                    <button class="ghost" type="button" id="goLogin">LOGIN</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>New here?</h1>
                    <p>Create an account and start managing the library system for free.</p>
                    <button class="ghost" type="button" id="goRegister">SIGN UP</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');

        document.getElementById('goRegister').addEventListener('click', () => {
            container.classList.add('right-panel-active');
            history.replaceState(null, '', '{{ route('register') }}');
        });

        document.getElementById('goLogin').addEventListener('click', () => {
            container.classList.remove('right-panel-active');
            history.replaceState(null, '', '{{ route('login') }}');
        });

     
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => {
                const btn = form.querySelector('button[type="submit"]');
                if (btn) { btn.disabled = true; btn.textContent = 'Please wait...'; }
            });
        });

    
        window.addEventListener('pageshow', e => { if (e.persisted) location.reload(); });
    </script>
</body>
</html>