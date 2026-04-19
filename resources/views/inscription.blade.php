<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire | FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2 {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-b from-emerald-700 to-emerald-500 text-white p-10">
            <a href="{{route('accueil')}}" ><h1 class="text-4xl font-bold" >FootQuartier</h1></a>
            <p class="text-lg text-white/90">Rejoignez l'élite du football amateur dans votre quartier.</p>
        </div>

        <div class="p-6 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-emerald-700 mb-2">Créez votre compte</h2>
            <p class="text-gray-600 mb-4">Créez votre compte <span><a href="{{route('accueil')}}" class="text-emerald-600 font-semibold hover:underline">FootQuartier</a></span> et commencez à réserver vos terrains facilement.</p>

            <form action="{{ route('inscription') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="full_name" placeholder="Nom complet" value="{{ old('full_name') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                @error('full_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror    

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
                @if (\App\Models\User::count() > 1)
<select name="role"
    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white focus:ring-2 focus:ring-emerald-400 focus:outline-none">

    <option value="" disabled {{ old('role', $role ?? '') ? '' : 'selected' }}>
        Choisir votre rôle
    </option>

    <option value="joueur"
        {{ old('role', $role ?? '') == 'joueur' ? 'selected' : '' }}>
        Joueur
    </option>

    <option value="moderateur"
        {{ old('role', $role ?? '') == 'moderateur' ? 'selected' : '' }}>
        Modérateur
    </option>

</select>
                @endif
                @error('role')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="w-full py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 transition-colors">
                    S'inscrire
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6 text-sm">
                Déjà un compte ?
                <a href="{{route('login')}}" class="text-emerald-600 font-semibold hover:underline">Se connecter</a>
            </p>
        </div>

    </div>

</body>

</html>