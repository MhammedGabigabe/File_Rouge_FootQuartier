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

        .step-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(5, 150, 105, 0.15);
        }

        .step-number {
            font-family: 'Lexend', sans-serif;
            font-weight: 900;
            font-size: 6rem;
            line-height: 1;
            color: #d1fae5;
            position: absolute;
            top: -10px;
            right: 12px;
            pointer-events: none;
            user-select: none;
        }

        .slider-track {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(calc(-100% / 2));
            }
        }

        .slider-wrapper {
            overflow: hidden;
            height: 480px;
            border-radius: 1rem;
        }

        .slider-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 0.75rem;
            flex-shrink: 0;
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
                <a href="{{route('terrains')}}">Terrains</a>
                <a href="#">Tournois</a>
                <a href="#apropos" class="text-emerald-600 font-semibold">À propos</a>
            </div>
            <div class="flex gap-3">
                @guest
                    <a href="{{route('connexion')}}" class="px-4 py-2 text-sm">Se connecter</a>
                    <a href="{{ route('inscription') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">S'inscrire</a>
                @endguest
                @auth

                    @if(Auth::user()->roles->contains('titre', 'Admin'))

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

    <main class="pt-12">

        <section class="min-h-screen flex items-center bg-gray-100">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 p-6 items-center">
                <div>
                    <h1 class="text-3xl md:text-5xl font-bold text-emerald-700 mb-6">
                        Votre Ville,<br>Votre Match. <br>
                        <span class="text-2xl text-emerald-600">Réservez en quelques secondes.</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-lg mb-6">
                        Rejoignez la première plateforme pour les passionnés de football.
                        Réservez des terrains, participez à des tournois et forgez votre légende.
                    </p>
                    <div class="flex gap-4">
                        @guest
                            <a href="{{ route('inscription') }}"
                                class="bg-emerald-600 text-white px-6 py-3 rounded">S'inscrire</a>
                            <a href="{{route('connexion')}}" class="bg-gray-300 px-6 py-3 rounded">Se connecter</a>
                        @endguest
                        @auth
                            <a href="{{ route('terrains') }}"
                                class="bg-emerald-600 text-white px-6 py-3 rounded">Réserver</a>
                            <a href="#" class="bg-gray-300 px-6 py-3 rounded">Participer</a>    
                        @endauth
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkB18XOvUNP1tZHBN8HISPH3tkHEXRsOx2OdyFN_EZZvVlctY_NUGCnMcVg_jiqYhHAieOQMk5aOnngALlJ4qlFbMO47RrJcX1lpRPGPHE5PGSGoOBogjUEwREDA5BCc4gtX_2-y8knMaCeMWnUVdl5wibYbuBbP4jJTlU-jwxHhrzhpu9E8e_3O4xmEhmbrHwdNXbAPrxx5hEvs20tjzGIfm7WkvKsfk36ieB96_TG0U8WdNfpTT0WeB_BE4r_JOJnzCk72I1qTeJ"
                        class="rounded-lg w-full max-w-sm md:max-w-md">
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
                            trouver facilement des terrains et organiser leurs matchs.
                        </p>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Notre objectif est de simplifier la réservation des terrains et de créer une
                            communauté active autour du football amateur.
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">100+</p>
                                <p class="text-sm text-gray-500 mt-1">Terrains disponibles</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">5k+</p>
                                <p class="text-sm text-gray-500 mt-1">Joueurs inscrits</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">500+</p>
                                <p class="text-sm text-gray-500 mt-1">Matchs par semaine</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
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

        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-10 items-center">

                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            Devenir <span class="text-emerald-600">Membre</span> FootQuartier
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Ce compte permet de jouer avec d'autres personnes, réserver des terrains
                            facilement et participer aux tournois.
                        </p>
                    </div>

                    <div>
                        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000&auto=format&fit=crop"
                            alt="terrain"
                            class="rounded-lg w-full h-80 object-cover">
                    </div>

                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-10 items-center">

                    <div>
                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop"
                            alt="gerant"
                            class="rounded-lg w-full h-80 object-cover">
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            Devenir <span class="text-emerald-600">Modérateur</span>
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Ce compte est destiné aux gérants de terrains. Il permet de gérer les terrains, 
                            les réservations et d’organiser des tournois facilement.
                        </p>
                    </div>

                </div>
            </div>
        </section>

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
                        <li><a href="#apropos">À propos</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-2">Contact</h4>
                    <p class="text-sm">contact@footquartier.com</p>
                </div>

            </div>
        </div>
        <p class="text-center text-xs mt-6 ml-20">© 2026 FootQuartier</p>
    </footer>

</body>

</html>
