<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AttractieStats</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-cover bg-center mx-[20px]" style="background-image: url('https://attractiestats.nl/img/bg.png');">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-blue-500 mb-6">Registreer bij AttractieStats</h1>
        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Gebruikersnaam</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig Wachtwoord</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Registreer
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Heb je al een account? <a href="/login" class="text-blue-500 hover:underline">Log hier in</a>
        </p>
    </div>
</body>
</html>
