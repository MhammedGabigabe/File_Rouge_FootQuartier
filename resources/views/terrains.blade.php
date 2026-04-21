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

        .terrain-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .terrain-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(5, 150, 105, 0.12);
        }

        .badge-equip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 999px;
            background: #f0fdf4;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        select:focus,
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15);
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            color: #374151;
            font-size: 0.9rem;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar-nav-link:hover {
            background: #f0fdf4;
            color: #059669;
        }

        .sidebar-nav-link.active {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .public-nav-link {
            position: relative;
            color: #374151;
            transition: color 0.2s;
        }

        .public-nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #059669;
            transition: width 0.25s;
        }

        .public-nav-link:hover {
            color: #059669;
        }

        .public-nav-link:hover::after {
            width: 100%;
        }

        .public-nav-link.active {
            color: #059669;
            font-weight: 600;
        }

        .public-nav-link.active::after {
            width: 100%;
        }
    </style>
</head>


<body class="bg-gray-50 text-gray-800 min-h-screen 
    @auth flex overflow-hidden h-screen @endauth">

    @auth
        <aside class="w-64 bg-white shadow-lg flex flex-col justify-between fixed h-full z-40">
            <div>
                <div class="p-6 border-b">
                    <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                    <p class="text-xs text-gray-400 mt-1">Espace Joueur</p>
                </div>

                <nav class="p-4 space-y-1">
                    <a href="{{ route('joueur.dashboard') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Tableau de bord
                    </a>

                    <a href="{{ route('terrains') }}"
                        class="sidebar-nav-link {{ request()->routeIs('terrains') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Rechercher un terrain
                    </a>

                    <a href="{{ route('joueur.reservations') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.reservations') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Mes réservations
                    </a>

                    <a href="{{ route('annonces') }}"
                        class="sidebar-nav-link {{ request()->routeIs('annonces') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Trouver un match
                    </a>

                    <a href="{{ route('joueur.participations') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.participations') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Mes participations
                    </a>

                    <a href="{{ route('joueur.points') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.points') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mes points
                    </a>

                    <a href="{{ route('joueur.historique') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.historique') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Historique
                    </a>

                    <a href="{{ route('joueur.notifications') }}"
                        class="sidebar-nav-link {{ request()->routeIs('joueur.notifications') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Notifications
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>

                    @php
                        $roleMod = Auth::user()->isModerateur();
                        $roleAdmin = Auth::user()->isAdmin();
                    @endphp

                    @if ($roleMod)
                        <a href="{{ route('moderator.dashboard') }}" class="sidebar-nav-link">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Espace Modérateur
                        </a>
                    @endif

                    @if ($roleAdmin)
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Espace Admin
                        </a>
                    @endif
                </nav>
            </div>

            <div class="p-4 border-t flex-shrink-0">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left sidebar-nav-link text-red-500 hover:bg-red-50 hover:text-red-600">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>
    @endauth

    @guest
        <nav class="fixed top-0 w-full bg-white shadow-sm z-50">
            <div class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">
                <a href="{{ route('accueil') }}">
                    <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                </a>
                <div class="hidden md:flex gap-8 text-sm">
                    <a href="{{ route('accueil') }}" class="public-nav-link">Accueil</a>
                    <a href="{{ route('terrains') }}" class="public-nav-link active">Terrains</a>
                    <a href="{{ route('annonces') }}" class="public-nav-link">Matchs</a>
                    <a href="{{ route('accueil') }}#apropos" class="public-nav-link">À propos</a>
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
    @endguest

    <div class="flex-1 min-w-0
        @auth ml-64 @endauth
        @guest pt-24 @endguest">

        <main class="p-6 pb-16">
            @auth
                <div class="flex justify-end mb-6">
                    <div class="flex items-center gap-4 ">
                        <span class="text-sm text-gray-500">
                            Solde :
                            <span class="text-emerald-600 font-bold">
                                {{ Auth::user()->pointsCompte }} pts
                            </span>
                        </span>

                        <a href="{{ route('joueur.points') }}"
                            class="px-3 py-1.5 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">
                            Recharger
                        </a>
                    </div>
                </div>
            @endauth

            <form method="GET" action="{{ route('terrains') }}">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <input type="text" name="localisation" oninput="autoSubmit(this)"
                                value="{{ request('localisation') }}" placeholder="Ville, quartier..."
                                class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:border-emerald-400 transition">
                        </div>

                        <select name="capacite" onchange="this.form.submit()"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 focus:border-emerald-400 transition bg-white">
                            <option value="">Toutes les capacités</option>
                            <option value="5" {{ request('capacite') == '5' ? 'selected' : '' }}>5 vs 5</option>
                            <option value="7" {{ request('capacite') == '7' ? 'selected' : '' }}>7 vs 7</option>
                            <option value="11" {{ request('capacite') == '11' ? 'selected' : '' }}>11 vs 11
                            </option>
                        </select>

                        <select name="equipement" onchange="this.form.submit()"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 focus:border-emerald-400 transition bg-white">
                            <option value="">Tous les équipements</option>
                            <option value="vestiaires" {{ request('equipement') == 'vestiaires' ? 'selected' : '' }}>
                                Vestiaires</option>
                            <option value="eclairage" {{ request('equipement') == 'eclairage' ? 'selected' : '' }}>
                                Éclairage</option>
                            <option value="gazon_synthetique"
                                {{ request('equipement') == 'gazon_synthetique' ? 'selected' : '' }}>Gazon synthétique
                            </option>
                            <option value="parking" {{ request('equipement') == 'parking' ? 'selected' : '' }}>Parking
                            </option>
                            <option value="buvette" {{ request('equipement') == 'buvette' ? 'selected' : '' }}>Buvette
                            </option>
                        </select>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3 mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </form>

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

            @if ($terrains->hasPages())
                <div class="mt-10">
                    {{ $terrains->links() }}
                </div>
            @endif

        </main>

        @guest
            <footer class="bg-gray-100 py-10">
                <div class="max-w-6xl mx-auto px-6">
                    <div class="flex flex-col md:flex-row justify-between gap-6">
                        <div>
                            <h3 class="font-bold text-emerald-700 mb-2">FootQuartier</h3>
                            <p class="text-sm text-gray-500">Plateforme de réservation de terrains.</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Navigation</h4>
                            <ul class="text-sm space-y-2 text-gray-600">
                                <li><a href="{{ route('terrains') }}"
                                        class="hover:text-emerald-600 transition">Terrains</a></li>
                                <li><a href="{{ route('annonces') }}"
                                        class="hover:text-emerald-600 transition">Matchs</a></li>
                                <li><a href="{{ route('accueil') }}#apropos" class="hover:text-emerald-600 transition">À
                                        propos</a></li>
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
        @endguest

    </div>

</body>

<script>
    let timeout = null;

    function autoSubmit(input) {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            if (input.value.trim().length >= 1) {
                input.form.submit();
            }
        });
    }
</script>


</html>
