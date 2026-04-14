<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terrains - FootQuartier</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;900&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="fixed top-0 w-full bg-white shadow z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <a href="{{ route('accueil') }}">
                <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
            </a>

            <div class="hidden md:flex gap-6 text-sm">
                <a href="{{ route('terrains') }}" class="text-emerald-600 font-semibold">Terrains</a>
                <a href="#">Tournois</a>
                <a href="{{ route('accueil') }}#apropos">À propos</a>
            </div>

            <div class="flex gap-3">
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm">Se connecter</a>
                    <a href="{{ route('inscription') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">S'inscrire</a>
                @endguest
                @auth

                    @if (Auth::user()->roles->contains('titre', 'Admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                            Dashboard Admin
                        </a>
                    @elseif(Auth::user()->roles->contains('titre', 'Moderateur'))
                        <a href="{{ route('moderator.dashboard') }}"
                            class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Dashboard Modérateur
                        </a>
                    @else
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-700">
                                Salut, <span class="text-emerald-600">{{ Auth::user()->nom }}</span>
                            </span>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="px-4 py-2 text-sm text-red-600 font-semibold hover:bg-red-50 rounded-lg">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @endif

                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-16 max-w-6xl mx-auto px-6">

        <header class="mb-10">
            <h1 class="text-3xl font-bold text-emerald-700 mb-2">
                Découvrez les meilleurs terrains de votre ville
            </h1>
            <p class="text-sm text-gray-500">
                Réservez en quelques clics les terrains les plus prestigieux de votre quartier pour vos matchs entre
                amis ou vos entraînements intensifs.
            </p>
        </header>

        <div class="bg-white p-4 rounded-xl shadow mb-8">
            <input type="text" placeholder="Rechercher par ville ou prix..."
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80"
                    class="w-full h-48 object-cover rounded-t-xl">

                <div class="p-4">
                    <h3 class="font-bold text-lg">Terrain Hay Riad</h3>
                    <p class="text-sm text-gray-500 mb-2">Rabat</p>

                    <div class="flex justify-between text-sm mb-3">
                        <span>5 vs 5</span>
                        <span class="text-emerald-600 font-semibold">150 MAD/h</span>
                    </div>

                    <button class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700">
                        Réserver
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80"
                    class="w-full h-48 object-cover rounded-t-xl">

                <div class="p-4">
                    <h3 class="font-bold text-lg">Complexe Sportif Agdal</h3>
                    <p class="text-sm text-gray-500 mb-2">Rabat</p>

                    <div class="flex justify-between text-sm mb-3">
                        <span>7 vs 7</span>
                        <span class="text-emerald-600 font-semibold">200 MAD/h</span>
                    </div>

                    <button class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700">
                        Réserver
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80"
                    class="w-full h-48 object-cover rounded-t-xl">

                <div class="p-4">
                    <h3 class="font-bold text-lg">Terrain Salé Centre</h3>
                    <p class="text-sm text-gray-500 mb-2">Salé</p>

                    <div class="flex justify-between text-sm mb-3">
                        <span>5 vs 5</span>
                        <span class="text-emerald-600 font-semibold">120 MAD/h</span>
                    </div>

                    <button class="w-full bg-emerald-600 text-white py-2 rounded hover:bg-emerald-700">
                        Réserver
                    </button>
                </div>
            </div>

        </div>

        <div class="mt-10 flex justify-center gap-3">
            <button class="px-4 py-2 bg-gray-200 rounded">1</button>
            <button class="px-4 py-2 bg-white border rounded hover:bg-gray-100">2</button>
            <button class="px-4 py-2 bg-white border rounded hover:bg-gray-100">3</button>
        </div>

    </main>

    <footer class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto p-6">
            <div class="flex flex-col md:flex-row justify-between gap-6">
                <div>
                    <a href="{{ route('accueil') }}">
                        <h3 class="font-bold mb-2">FootQuartier</h3>
                    </a>
                    <p class="text-sm">Plateforme de réservation de terrains.</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-2">Plateforme</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="#">À propos</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-2">Contact</h4>
                    <p class="text-sm">contact@footquartier.com</p>
                </div>
            </div>
        </div>

        <p class="text-center text-xs mt-6">© 2026 FootQuartier</p>
    </footer>

</body>

</html>
