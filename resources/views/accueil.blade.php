<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootQuartier</title>
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

        .slider-wrapper {
            overflow: hidden;
            height: 480px;
            border-radius: 1rem;
        }

        .slider-track {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .slider-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 0.75rem;
            flex-shrink: 0;
        }

        .nav-link {
            position: relative;
            color: #374151;
            transition: color 0.2s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #059669;
            transition: width 0.25s;
        }

        .nav-link:hover {
            color: #059669;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: #059669;
            font-weight: 600;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .terrain-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .terrain-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(5, 150, 105, 0.12);
        }

        .annonce-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .annonce-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(5, 150, 105, 0.12);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="fixed top-0 w-full bg-white shadow-sm z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">

            <a href="{{ route('accueil') }}">
                <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
            </a>

            <div class="hidden md:flex gap-8 text-sm">
                <a href="{{ route('accueil') }}" class="nav-link active">Accueil</a>
                <a href="#terrains" class="nav-link">Terrains</a>
                <a href="#matchs" class="nav-link">Matchs</a>
                <a href="#apropos" class="nav-link">À propos</a>
            </div>

            <div class="flex gap-3 items-center">
                @guest
                    <a href="{{ route('connexion') }}"
                        class="px-4 py-2 text-sm text-gray-700 hover:text-emerald-600 font-medium transition">
                        Se connecter
                    </a>
                    <a href="{{ route('inscription') }}"
                        class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition font-medium">
                        S'inscrire
                    </a>
                @endguest

                @auth
                    @if (Auth::user()->roles->contains('titre', 'admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                            Dashboard Admin
                        </a>
                    @elseif(Auth::user()->roles->contains('titre', 'moderateur'))
                        <a href="{{ route('moderator.dashboard') }}"
                            class="px-4 py-2 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                            Dashboard Modérateur
                        </a>
                    @else
                        <span class="text-sm text-gray-600">
                            Salut, <span class="text-emerald-600 font-semibold">{{ Auth::user()->nom }}</span>
                        </span>
                        <a href="{{ route('terrains') }}"
                            class="px-4 py-2 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                            Réserver
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                class="px-4 py-2 text-sm text-red-500 font-medium hover:bg-red-50 rounded-lg transition">
                                Déconnexion
                            </button>
                        </form>
                    @endif
                @endauth
            </div>

        </div>
    </nav>

    <main class="pt-16">

        <section class="min-h-screen flex items-center bg-gray-100">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 p-6 items-center">
                <div>
                    <h1 class="text-3xl md:text-5xl font-bold text-emerald-700 mb-6">
                        Votre Ville,<br>Votre Match.<br>
                        <span class="text-2xl text-emerald-600">Réservez en quelques secondes.</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-lg mb-8">
                        Rejoignez la première plateforme pour les passionnés de football.
                        Réservez des terrains, participez à des matchs annoncés.
                    </p>
                    <div class="flex gap-4 flex-wrap">
                        @guest
                            <a href="{{ route('inscription') }}"
                                class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                                S'inscrire
                            </a>
                            <a href="{{ route('connexion') }}"
                                class="bg-white border border-gray-300 px-6 py-3 rounded-lg font-medium hover:border-emerald-400 transition">
                                Se connecter
                            </a>
                        @endguest
                        @auth
                            <a href="{{ route('terrains') }}"
                                class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                                Réserver un terrain
                            </a>
                            <a href="{{ route('annonces') }}"
                                class="bg-white border border-gray-300 px-6 py-3 rounded-lg font-medium hover:border-emerald-400 transition">
                                Voir les matchs
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkB18XOvUNP1tZHBN8HISPH3tkHEXRsOx2OdyFN_EZZvVlctY_NUGCnMcVg_jiqYhHAieOQMk5aOnngALlJ4qlFbMO47RrJcX1lpRPGPHE5PGSGoOBogjUEwREDA5BCc4gtX_2-y8knMaCeMWnUVdl5wibYbuBbP4jJTlU-jwxHhrzhpu9E8e_3O4xmEhmbrHwdNXbAPrxx5hEvs20tjzGIfm7WkvKsfk36ieB96_TG0U8WdNfpTT0WeB_BE4r_JOJnzCk72I1qTeJ"
                        class="rounded-2xl w-full max-w-sm md:max-w-md shadow-lg">
                </div>
            </div>
        </section>


        <section id="terrains" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold text-emerald-600">Terrains disponibles</h2>
                    <a href="{{ route('terrains') }}" class="text-emerald-600 text-sm font-semibold hover:underline">
                        Voir tous →
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    @forelse($terrains as $terrain)
                        <div class="terrain-card bg-white rounded-2xl shadow overflow-hidden border border-gray-100">
                            @if ($terrain->photo)
                                <img src="{{ asset('storage/' . $terrain->photo) }}" alt="{{ $terrain->nom_terrain }}"
                                    class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 bg-emerald-50 flex items-center justify-center">
                                    <span class="text-emerald-300 text-4xl">⚽</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-1">{{ $terrain->nom_terrain }}</h3>
                                <p class="text-sm text-gray-500 mb-2">📍 {{ $terrain->localisation }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-600 font-bold">{{ $terrain->prix }} DH</span>
                                    <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full">
                                        {{ $terrain->capacite }}v{{ $terrain->capacite }}
                                    </span>
                                </div>
                                <a href="{{ route('terrains.show', $terrain->id) }}"
                                    class="mt-3 block text-center bg-emerald-600 text-white py-2 rounded-lg text-sm hover:bg-emerald-700 transition">
                                    Voir le terrain
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center">Aucun terrain disponible pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="matchs" class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold text-emerald-600">Matchs disponibles</h2>
                    <a href="{{ route('annonces') }}" class="text-emerald-600 text-sm font-semibold hover:underline">
                        Voir tous →
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    @forelse($annonces as $annonce)
                        <div
                            class="annonce-card bg-white rounded-2xl shadow overflow-hidden border border-gray-100 p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-bold text-lg">{{ $annonce->reservation->terrain->nom_terrain }}</h3>
                                <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-1 rounded-full font-medium">
                                    {{ $annonce->places_dispo }} place(s)
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">
                                📍 {{ $annonce->reservation->terrain->localisation }}
                            </p>
                            <p class="text-sm text-gray-500 mb-1">
                                📅 {{ $annonce->reservation->date_debut->format('d/m/Y H:i') }}
                            </p>
                            <p class="text-sm text-gray-500 mb-4">
                                👤 Organisé par {{ $annonce->organisateur->nom }}
                            </p>
                            <a href="{{ route('annonces.show', $annonce->id) }}"
                                class="block text-center bg-emerald-600 text-white py-2 rounded-lg text-sm hover:bg-emerald-700 transition">
                                Rejoindre le match
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center">Aucun match disponible pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="apropos" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-14 items-center">

                    <div class="slider-wrapper shadow-xl">
                        <div class="slider-track">
                            <img class="slider-img"
                                src="https://images.unsplash.com/photo-1529900748604-07564a03e7a6?w=600&q=80"
                                alt="Terrain 1">
                            <img class="slider-img"
                                src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=600&q=80"
                                alt="Ball">
                        </div>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-emerald-700 mb-4">À propos de FootQuartier</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            FootQuartier est une plateforme dédiée aux passionnés de football qui souhaitent
                            trouver facilement des terrains, organiser leurs matchs et annoncer ces matchs
                            si besoin de joueurs ou d'une équipe adverse.
                        </p>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Notre objectif est de simplifier la réservation des terrains et de créer une
                            communauté active autour du football amateur.
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-emerald-50 rounded-xl p-3 text-center">
                                <p class="text-3xl font-bold text-emerald-700">100+</p>
                                <p class="text-sm text-gray-500 mt-1">Terrains disponibles</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-3 text-center">
                                <p class="text-3xl font-bold text-emerald-700">5k+</p>
                                <p class="text-sm text-gray-500 mt-1">Joueurs inscrits</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-3 text-center">
                                <p class="text-3xl font-bold text-emerald-700">500+</p>
                                <p class="text-sm text-gray-500 mt-1">Matchs par semaine</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-3 text-center">
                                <p class="text-3xl font-bold text-emerald-700">15</p>
                                <p class="text-sm text-gray-500 mt-1">Villes couvertes</p>
                            </div>
                        </div>

                        @guest
                            <a href="{{ route('inscription') }}"
                                class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition-colors">
                                Rejoindre la communauté
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endguest
                    </div>

                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-10 items-center mb-20">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            Devenir <span class="text-emerald-600">Joueur</span> FootQuartier
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Ce compte permet de réserver des terrains, participer aux matchs
                            annoncés et interagir avec la communauté.
                        </p>
                        @guest
                            <a href="{{ route('inscription') }}"
                                class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                                S'inscrire comme joueur
                            </a>
                        @endguest
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000&auto=format&fit=crop"
                            alt="joueur" class="rounded-2xl w-full h-80 object-cover shadow">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div>
                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop"
                            alt="moderateur" class="rounded-2xl w-full h-80 object-cover shadow">
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            Devenir <span class="text-emerald-600">Modérateur</span>
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Ce compte est destiné aux gérants de terrains. Il permet de gérer les terrains,
                            les réservations et de maintenir le respect dans votre complexe.
                        </p>
                        @guest
                            <a href="{{ route('inscription') }}"
                                class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                                S'inscrire comme modérateur
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between gap-6">
                <div>
                    <a href="{{ route('accueil') }}">
                        <h3 class="font-bold text-emerald-700 mb-2">FootQuartier</h3>
                    </a>
                    <p class="text-sm text-gray-500">Plateforme de réservation de terrains.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Navigation</h4>
                    <ul class="text-sm space-y-2 text-gray-600">
                        <li><a href="#terrains" class="hover:text-emerald-600 transition">Terrains</a>
                        </li>
                        <li><a href="#matchs" class="hover:text-emerald-600 transition">Matchs</a>
                        </li>
                        <li><a href="#apropos" class="hover:text-emerald-600 transition">À propos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Contact</h4>
                    <p class="text-sm text-gray-500">contact@footquartier.com</p>
                </div>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-6">© 2026 FootQuartier</p>
    </footer>

</body>

</html>
