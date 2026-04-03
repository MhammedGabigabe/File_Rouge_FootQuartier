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
                <a href="#">Terrains</a>
                <a href="#">Tournois</a>
                <a href="#apropos" class="text-emerald-600 font-semibold">À propos</a>
            </div>
            <div class="flex gap-3">
                <a href="{{route('connexion')}}" class="px-4 py-2 text-sm">Se connecter</a>
                <a href="{{ route('inscription') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">S'inscrire</a>
            </div>
        </div>
    </nav>

    <main class="pt-12">

        <section class="min-h-screen flex items-center bg-gray-100">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-10 p-6 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold text-emerald-700 mb-6">
                        Votre Ville,<br>Votre Match. <br>
                        <span class="text-3xl text-emerald-600">Réservez en quelques secondes.</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-lg mb-6">
                        Rejoignez la première plateforme pour les passionnés de football.
                        Réservez des terrains, participez à des tournois et forgez votre légende.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('inscription') }}"
                            class="bg-emerald-600 text-white px-6 py-3 rounded">S'inscrire</a>
                        <a href="{{route('connexion')}}" class="bg-gray-300 px-6 py-3 rounded">Se connecter</a>
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
                                <p class="text-3xl font-bold text-emerald-700">120+</p>
                                <p class="text-sm text-gray-500 mt-1">Terrains disponibles</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">5k+</p>
                                <p class="text-sm text-gray-500 mt-1">Joueurs inscrits</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">300+</p>
                                <p class="text-sm text-gray-500 mt-1">Matchs par semaine</p>
                            </div>
                            <div class="bg-emerald-50 rounded-xl p-4 text-center">
                                <p class="text-3xl font-bold text-emerald-700">15</p>
                                <p class="text-sm text-gray-500 mt-1">Villes couvertes</p>
                            </div>
                        </div>

                        <a href="{{ route('inscription') }}"
                            class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition-colors">
                            Rejoindre la communauté
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">

                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800">Comment ça marche</h2>
                    <p class="text-gray-500 mt-2">3 étapes simples pour jouer avec vos amis</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">

                    <div class="bg-emerald-600 text-white p-6 rounded-xl shadow">
                        <p class="text-5xl font-bold text-emerald-200 text-right">1</p>

                        <div class="mt-4">
                            <div class="w-10 h-10 bg-white/20 rounded flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="M21 21l-4.35-4.35" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-1">Trouver un terrain</h3>
                            <p class="text-sm text-emerald-100">
                                Cherchez parmi les terrains disponibles près de chez vous.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white border p-6 rounded-xl shadow">
                        <p class="text-5xl font-bold text-gray-200 text-right">2</p>

                        <div class="mt-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-1 text-gray-800">Réserver</h3>
                            <p class="text-sm text-gray-500">
                                Choisissez votre créneau et confirmez rapidement.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white border p-6 rounded-xl shadow">
                        <p class="text-5xl font-bold text-gray-200 text-right">3</p>

                        <div class="mt-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                                    <path d="M2 12h20" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-1 text-gray-800">Jouer</h3>
                            <p class="text-sm text-gray-500">
                                Rendez-vous au terrain et profitez du match.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('inscription') }}"
                        class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700">
                        Commencer maintenant
                    </a>
                </div>

            </div>

        </section>

        <section class="py-16 bg-emerald-600 text-white text-center">
            <h2 class="text-3xl font-bold mb-6">Prêt à jouer ?</h2>
            <p class="mb-6">Rejoignez la plateforme maintenant</p>
            <a href="{{ route('inscription') }}" class="bg-white text-emerald-700 px-6 py-3 rounded font-bold">
                S'inscrire
            </a>
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
        <p class="text-center text-xs mt-6">© 2026 FootQuartier</p>
    </footer>

</body>

</html>
