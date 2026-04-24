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
                <a href="{{ route('accueil') }}" class="nav-link active" id="link-accueil">Accueil</a>
                <a href="#terrains" class="nav-link" id="link-terrains">Terrains</a>
                <a href="#matchs" class="nav-link" id="link-matchs">Matchs</a>
                <a href="#apropos" class="nav-link" id="link-apropos">À propos</a>
            </div>

            <div class="flex gap-3 items-center">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm text-gray-700 hover:text-emerald-600 font-medium transition">
                    Se connecter
                </a>
                <a href="{{ route('inscription') }}"
                    class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition font-medium">
                    S'inscrire
                </a>
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
                        <a href="{{ route('inscription') }}"
                            class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                            S'inscrire
                        </a>
                        <a href="{{ route('login') }}"
                            class="bg-white border border-gray-300 px-6 py-3 rounded-lg font-medium hover:border-emerald-400 transition">
                            Se connecter
                        </a>
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

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($terrains as $terrain)
                        @php
                            $equips = is_array($terrain->equipements) ? $terrain->equipements : [];
                            $equipsLabels = [
                                'vestiaires' => 'Vestiaires',
                                'eclairage' => 'Éclairage',
                                'gazon_synthetique' => 'Gazon synthétique',
                                'parking' => 'Parking',
                                'buvette' => 'Buvette',
                            ];
                        @endphp

                        <a href="{{ route('terrains.show', $terrain->id) }}">
                            <div
                                class="terrain-card bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $terrain->photo) }}"
                                        alt="{{ $terrain->nom_terrain }}" class="w-full h-44 object-cover">
                                    <span
                                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                                        {{ $terrain->capacite }}v{{ $terrain->capacite }}
                                    </span>
                                    <span
                                        class="absolute top-3 right-3 bg-emerald-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                                        {{ $terrain->prix }} DH/h
                                    </span>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-bold text-base mb-1">{{ $terrain->nom_terrain }}</h3>

                                    <div class="flex items-center gap-1 text-gray-400 text-xs mb-3">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        {{ $terrain->localisation }}
                                    </div>

                                    @if (count($equips) > 0)
                                        <div class="flex flex-wrap gap-1 mb-3">
                                            @foreach (array_slice($equips, 0, 3) as $eq)
                                                @php $eq = is_array($eq) ? $eq[0] : $eq; @endphp
                                                <span
                                                    class="badge-equip">{{ $equipsLabels[$eq] ?? ucfirst(str_replace('_', ' ', $eq)) }}</span>
                                            @endforeach
                                            @if (count($equips) > 3)
                                                <span class="badge-equip">+{{ count($equips) - 3 }}</span>
                                            @endif
                                        </div>
                                    @endif


                                    @php
                                        $rating = round($terrain->avis_avg_note ?? 0);
                                    @endphp

                                    <div class="flex items-center gap-1 mb-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3.5 h-3.5 {{ $i <= $rating ? 'text-amber-400' : 'text-gray-200' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>

                                </div>
                            </div>
                        </a>

                    @empty
                        <div class="col-span-3 text-center py-16">
                            <p class="text-gray-400 font-medium">Aucun terrain trouvé avec ces filtres.</p>
                            <a href="{{ route('terrains') }}"
                                class="mt-3 inline-block text-emerald-600 text-sm hover:underline">
                                Réinitialiser les filtres
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="matchs" class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-bold text-emerald-600">Matchs disponibles</h2>
                    <a href="#route('annonces') " class="text-emerald-600 text-sm font-semibold hover:underline">
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
                                {{ $annonce->reservation->terrain->localisation }}
                            </p>
                            <p class="text-sm text-gray-500 mb-1">
                                {{ $annonce->reservation->date_debut->format('d/m/Y H:i') }}
                            </p>
                            <p class="text-sm text-gray-500 mb-4">
                                Organisé par {{ $annonce->organisateur->nom }}
                            </p>
                            <a href="#route('annonces.show', $annonce->id)"
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
                        <a href="{{ route('inscription', ['role' => 'joueur']) }}"
                            class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                            S'inscrire comme joueur
                        </a>

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
                        <a href="{{ route('inscription', ['role' => 'moderateur']) }}"
                            class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-emerald-700 transition">
                            S'inscrire comme modérateur
                        </a>
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

    <script>
        const links = document.querySelectorAll('.nav-link');

        function setActive(id) {
            links.forEach(link => link.classList.remove('active'));
            document.getElementById(id).classList.add('active');
        }

        document.getElementById('link-accueil').onclick = () => setActive('link-accueil');
        document.getElementById('link-terrains').onclick = () => setActive('link-terrains');
        document.getElementById('link-matchs').onclick = () => setActive('link-matchs');
        document.getElementById('link-apropos').onclick = () => setActive('link-apropos');

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;

            const terrains = document.getElementById('terrains').offsetTop - 100;
            const matchs = document.getElementById('matchs').offsetTop - 100;
            const apropos = document.getElementById('apropos').offsetTop - 100;

            if (scrollY >= apropos) {
                setActive('link-apropos');
            } else if (scrollY >= matchs) {
                setActive('link-matchs');
            } else if (scrollY >= terrains) {
                setActive('link-terrains');
            } else {
                setActive('link-accueil');
            }
        });
    </script>
</body>

</html>
