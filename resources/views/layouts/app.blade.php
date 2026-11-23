<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        nav { background: #2c3e50; padding: 12px 24px; }
        nav a { color: #fff; margin-right: 16px; text-decoration: none; }
        .container { max-width: 900px; margin: 24px auto; background: #fff; padding: 24px; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #ecf0f1; }
        input, select { padding: 6px; margin: 4px 8px 4px 0; }
        button { padding: 7px 16px; background: #2c3e50; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .success { background: #d4edda; padding: 10px; margin-bottom: 12px; border-radius: 4px; }
        .error { background: #f8d7da; padding: 10px; margin-bottom: 12px; border-radius: 4px; }
    </style>
</head>
<body>
    <nav style="display:flex; align-items:center; justify-content:space-between;">
    <div>
        <a href="{{ route('books.index') }}">Books</a>
        <a href="{{ route('authors.index') }}">Authors</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="{{ route('members.index') }}">Members</a>
        <a href="{{ route('library-cards.index') }}">Library Cards</a>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <span style="color:#fff; margin-right:10px;">{{ auth()->user()->name }}</span>
        <button type="submit">Logout</button>
    </form>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>
    <script>
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