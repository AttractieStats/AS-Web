<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AttractieStats</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-cover bg-center mx-[20px]" style="background-image: url('https://attractiestats.nl/img/bg.png');">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-blue-500 mb-6">Welkom bij AttractieStats</h1>
        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Log in
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Heb je nog geen account? <a href="/register" class="text-blue-500 hover:underline">Registreer hier</a>
        </p>
    </div>
</body>
</html>
