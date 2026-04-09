<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold mb-4">Dashboard Test</h1>
        <p>User: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        
        <div class="mt-8">
            <a href="{{ route('home') }}" class="bg-purple-600 text-white px-6 py-2 rounded">Ke Homepage</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded ml-4">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
