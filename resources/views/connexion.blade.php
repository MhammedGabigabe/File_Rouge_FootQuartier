<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter | FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2 {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-b from-emerald-700 to-emerald-500 text-white p-10">
            <a href="{{ route('accueil') }}"><h1 class="text-4xl font-bold">FootQuartier</h1></a>
            <p class="text-lg text-white/90">Retrouvez vos terrains en un seul endroit.</p>
        </div>

        <div class="p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-emerald-700 mb-4">Connectez-vous</h2>
            <p class="text-gray-600 mb-6">Bon retour sur <span><a href="{{ route('accueil') }}" class="text-emerald-600 font-semibold hover:underline">FootQuartier</a></span>. Accédez à votre espace et reprenez le jeu.</p>

            <form action="{{ route('connexion') }}" method="POST" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror  

                <input type="password" name="password" placeholder="Mot de passe"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror    

                <button type="submit"
                    class="w-full py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transition-colors">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6 text-sm">
                Pas encore de compte ?
                <a href="{{ route('inscription') }}" class="text-emerald-600 font-semibold hover:underline">S'inscrire</a>
            </p>
        </div>

    </div>

</body>

</html>