<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trouver un match | FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.stripe.com/v3/"></script>
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

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            color: #374151;
            font-size: 0.9rem;
            transition: background 0.2s, color 0.2s;
        }

        .nav-link:hover {
            background: #f0fdf4;
            color: #059669;
        }

        .nav-link.active {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .annonce-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: fadeUp 0.35s ease both;
        }

        .annonce-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(5, 150, 105, 0.12);
        }

        .annonce-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .annonce-card:nth-child(2) {
            animation-delay: 0.10s;
        }

        .annonce-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .annonce-card:nth-child(4) {
            animation-delay: 0.20s;
        }

        .annonce-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .annonce-card:nth-child(6) {
            animation-delay: 0.30s;
        }

        .badge-ouverte {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-fermee {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-complete {
            background: #fef9c3;
            color: #854d0e;
        }

        .places-bar {
            height: 6px;
            border-radius: 999px;
            background: #e5e7eb;
            overflow: hidden;
        }

        .places-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #059669, #34d399);
            transition: width 0.4s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .filter-chip {
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1.5px solid #d1d5db;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-chip:hover,
        .filter-chip.active {
            border-color: #059669;
            background: #d1fae5;
            color: #065f46;
        }

        .join-btn {
            background: linear-gradient(135deg, #059669, #047857);
            color: white;
            border-radius: 0.75rem;
            padding: 0.55rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            transition: opacity 0.2s, transform 0.15s;
        }

        .join-btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .join-btn:disabled {
            background: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        #modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }

        #modal-overlay.open {
            display: flex;
        }

        #modal-box {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.2);
            animation: fadeUp 0.25s ease;
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
                        class="nav-link {{ request()->routeIs('joueur.dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Tableau de bord
                    </a>
                    <a href="{{ route('terrains') }}" class="nav-link {{ request()->routeIs('terrains') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Rechercher un terrain
                    </a>
                    <a href="{{ route('joueur.reservations') }}"
                        class="nav-link {{ request()->routeIs('joueur.reservations') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Mes réservations
                    </a>
                    <a href="{{ route('annonces.public') }}"
                        class="nav-link {{ request()->routeIs('annonces.public') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Trouver un match
                    </a>
                    <a href="{{ route('joueur.participations') }}"
                        class="nav-link {{ request()->routeIs('joueur.participations') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Mes participations
                    </a>
                    <a href="{{ route('joueur.historique') }}"
                        class="nav-link {{ request()->routeIs('joueur.historique') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Historique
                    </a>
                    <a href="{{ route('joueur.notifications') }}"
                        class="nav-link {{ request()->routeIs('joueur.notifications') ? 'active' : '' }}">
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
                    @if (Auth::user()->isModerateur())
                        <a href="{{ route('moderator.dashboard') }}" class="nav-link">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Espace Modérateur
                        </a>
                    @endif
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Espace Admin
                        </a>
                    @endif
                </nav>
            </div>
            <div class="p-4 border-t">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left nav-link text-red-500 hover:bg-red-50 hover:text-red-600">
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
                    <a href="{{ route('terrains') }}" class="public-nav-link">Terrains</a>
                    <a href="{{ route('annonces.public') }}" class="public-nav-link active">Matchs</a>
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

        <main class="p-4 pb-16">

            @auth
                <div class="flex justify-end mb-10">
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">
                            Solde :
                            <span class="text-emerald-600 font-bold solde-display"">{{ Auth::user()->pointsCompte }}
                                pts</span>
                        </span>
                        <button onclick="openRechargeModal()"
                            class="px-3 py-1.5 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">
                            Recharger
                        </button>
                    </div>
                </div>
            @endauth

            <div class="mb-4">
                <p class="text-gray-500 text-sm mt-1">Rejoignez une annonce ouverte et complétez une équipe près de
                    chez vous.</p>
            </div>

            @if (session('success'))
                <div
                    class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
                <form method="GET" action="{{ route('annonces.public') }}"
                    class="flex flex-wrap gap-3 items-center">
                    <div class="flex-1 min-w-48">
                        <input type="text" name="ville" value="{{ request('ville') }}"
                            placeholder="Rechercher par Ville ou quartier…"
                            class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent">
                    </div>
                    <div class="flex-1 min-w-48">
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent text-gray-500">
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <button type="submit" class="join-btn px-4 py-2 text-sm">Filtrer</button>
                        @if (request('ville') || request('date'))
                            <a href="{{ route('annonces.public') }}" class="filter-chip flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Réinitialiser
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($annonces as $annonce)
                    @php
                        $terrain = $annonce->reservation->terrain;
                        $dateDebut = $annonce->reservation->date_debut;
                        $placesOccupees = $annonce->places_total - $annonce->places_dispo;
                        $pct = $annonce->places_total > 0 ? round(($placesOccupees / $annonce->places_total) * 100) : 0;
                        $dejaParticipe = $annonce->participations->contains('user_id', Auth::id());
                        $estOrganisateur = $annonce->user_id === Auth::id();
                        $complet = $annonce->places_dispo <= 0;
                        $badgeClass = match ($annonce->statut) {
                            'ouverte' => 'badge-ouverte',
                            'fermee' => 'badge-fermee',
                            default => 'badge-complete',
                        };
                        $coutParPlace = round($terrain->prix / ($terrain->capacite * 2));

                    @endphp

                    <div
                        class="annonce-card bg-white rounded-2xl shadow overflow-hidden border border-gray-100 p-5 flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $terrain->nom_terrain }}</h3>
                            <span
                                class="text-xs font-semibold px-2.5 py-1 rounded-full flex-shrink-0 ml-2 {{ $badgeClass }}">
                                {{ ucfirst($annonce->statut) }}
                            </span>
                        </div>

                        <div class="space-y-1.5 mb-4">
                            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                                {{ $terrain->localisation ?? 'Non précisé' }}
                            </p>
                            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                                {{ \Carbon\Carbon::parse($dateDebut)->translatedFormat('D d M Y') }}
                                — {{ \Carbon\Carbon::parse($dateDebut)->format('H:i') }}
                            </p>
                            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                                Organisé par <strong
                                    class="text-gray-700 ml-1">{{ $annonce->organisateur->nom }}</strong>
                            </p>
                            <p class="text-sm text-gray-500 flex items-center gap-1.5">
                                <span class="font-semibold text-emerald-600">{{ $coutParPlace }} pts</span>
                                <span class="text-gray-400">/ place</span>
                            </p>
                        </div>

                        <div class="mb-4 mt-auto">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>{{ $placesOccupees }} / {{ $annonce->places_total }} joueurs</span>
                                <span class="{{ $complet ? 'text-red-500' : 'text-emerald-600' }} font-medium">
                                    {{ $annonce->places_dispo }} place{{ $annonce->places_dispo > 1 ? 's' : '' }}
                                    restante{{ $annonce->places_dispo > 1 ? 's' : '' }}
                                </span>
                            </div>
                        </div>

                        @if ($estOrganisateur)
                            <span
                                class="block text-center text-xs text-emerald-700 font-semibold bg-emerald-50 px-3 py-2 rounded-xl">
                                Votre annonce
                            </span>
                        @elseif($dejaParticipe)
                            <span
                                class="block text-center text-xs text-blue-700 font-semibold bg-blue-50 px-3 py-2 rounded-xl mb-2">
                                ✓ Inscrit
                            </span>
                            <form method="POST" action="{{ route('participations.destroy', $annonce->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full text-xs text-red-500 hover:text-red-700 underline">
                                    Se désinscrire
                                </button>
                            </form>
                        @elseif($complet || $annonce->statut !== 'ouverte')
                            <button class="join-btn w-full text-center py-2" disabled>Complet</button>
                        @else
                            @auth
                                <button
                                    onclick="openModal({{ $annonce->id }}, '{{ $terrain->nom_terrain }}', '{{ \Carbon\Carbon::parse($dateDebut)->translatedFormat('D d M \à H:i') }}', {{ $annonce->places_dispo }})"
                                    class="join-btn w-full text-center py-2">
                                    Rejoindre
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block text-center bg-gray-200 text-gray-700 py-2 rounded-xl text-sm hover:bg-gray-300 transition font-medium">
                                    Se connecter pour rejoindre
                                </a>
                            @endauth
                        @endif
                    </div>

                @empty
                    <div class="col-span-3 text-center py-20">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-700 text-lg mb-1">Aucune annonce trouvée</h3>
                        <p class="text-gray-400 text-sm">Essayez d'autres filtres ou revenez plus tard.</p>
                    </div>
                @endforelse
            </div>

            @if ($annonces->hasPages())
                <div class="mt-6">
                    {{ $annonces->withQueryString()->links() }}
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
                                <li><a href="{{ route('annonces.public') }}"
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

    {{-- Modal Rechargement Points --}}
    @auth
        <div id="modal-recharge" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">

                <div id="step-montant" class="p-6 space-y-5">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900">Recharger mon compte</h3>
                        <button onclick="closeRechargeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div
                        class="bg-emerald-50 rounded-xl px-4 py-3 text-sm text-emerald-800 flex justify-between items-center">
                        <span>Solde actuel</span>
                        <span class="font-bold text-emerald-700">{{ Auth::user()->pointsCompte }} pts</span>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wide block mb-2">Montant à
                            recharger (1 DH = 1 point)</label>
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            @foreach ([50, 100, 200, 500] as $montant)
                                <button type="button" onclick="selectMontant({{ $montant }})"
                                    data-montant="{{ $montant }}"
                                    class="montant-chip py-2 text-sm font-semibold border-2 border-gray-200 rounded-xl hover:border-emerald-500 hover:bg-emerald-50 hover:text-emerald-700 transition text-gray-600">
                                    {{ $montant }} DH
                                </button>
                            @endforeach
                        </div>
                        <div class="relative">
                            <input type="number" id="montant-custom" placeholder="Ou saisir un montant (min. 10 DH)"
                                min="10" max="5000"
                                class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent"
                                oninput="onCustomMontant(this.value)">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">DH</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl px-4 py-3 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Points à créditer</span>
                        <span id="points-preview" class="text-xl font-bold text-emerald-600">-- pts</span>
                    </div>

                    <div id="recharge-error-1"
                        class="hidden bg-red-50 text-red-700 text-sm px-4 py-2.5 rounded-xl border border-red-200"></div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeRechargeModal()"
                            class="w-1/2 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition text-sm font-medium">
                            Annuler
                        </button>
                        <button type="button" id="btn-recharge-continuer" onclick="initRechargePayment()"
                            class="w-1/2 flex items-center justify-center gap-2 bg-emerald-600 text-white py-3 rounded-xl font-semibold hover:bg-emerald-700 transition text-sm">
                            Continuer →
                        </button>
                    </div>
                </div>

                <div id="step-paiement-recharge" class="hidden p-6 space-y-4">

                    <div class="flex items-center gap-3 mb-2">
                        <button type="button" onclick="backToMontant()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <h3 class="font-semibold text-gray-800">Paiement sécurisé</h3>
                    </div>

                    <div id="recap-recharge" class="bg-emerald-50 rounded-xl px-4 py-3 text-sm text-emerald-800"></div>

                    <div id="recharge-error-2"
                        class="hidden bg-red-50 text-red-700 text-sm px-4 py-2.5 rounded-xl border border-red-200"></div>

                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wide block mb-2">Carte
                            bancaire</label>
                        <div id="recharge-card-element" class="border border-gray-200 rounded-xl px-3 py-3 bg-white">
                        </div>
                    </div>

                    <button type="button" id="btn-recharge-payer" onclick="payRecharge()"
                        class="w-full flex items-center justify-center gap-2 bg-emerald-600 text-white py-3 rounded-xl font-semibold hover:bg-emerald-700 transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span id="btn-recharge-label">Payer et recharger</span>
                    </button>

                    <p class="text-center text-xs text-gray-400 flex items-center justify-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Paiement sécurisé par Stripe
                    </p>
                </div>

            </div>
        </div>

        <script>
            let rechargeStripe = Stripe("{{ config('services.stripe.key') }}");
            let rechargeElements = rechargeStripe.elements();
            let rechargeCardElement = null;
            let rechargeClientSecret = null;
            let rechargeMontantSelected = null;

            function openRechargeModal() {
                document.getElementById('modal-recharge').classList.remove('hidden');
                if (!rechargeCardElement) {
                    rechargeCardElement = rechargeElements.create('card', {
                        style: {
                            base: {
                                fontSize: '14px',
                                color: '#1f2937',
                                '::placeholder': {
                                    color: '#9ca3af'
                                }
                            }
                        }
                    });
                    rechargeCardElement.mount('#recharge-card-element');
                }
            }

            function closeRechargeModal() {
                document.getElementById('modal-recharge').classList.add('hidden');
                backToMontant();
                document.querySelectorAll('.montant-chip').forEach(c => c.classList.remove('border-emerald-500',
                    'bg-emerald-50', 'text-emerald-700'));
                document.getElementById('montant-custom').value = '';
                document.getElementById('points-preview').textContent = '-- pts';
                document.getElementById('recharge-error-1').classList.add('hidden');
                rechargeMontantSelected = null;
            }

            function selectMontant(val) {
                rechargeMontantSelected = val;
                document.getElementById('montant-custom').value = '';
                document.getElementById('points-preview').textContent = val + ' pts';
                document.querySelectorAll('.montant-chip').forEach(c => {
                    const isActive = parseInt(c.dataset.montant) === parseInt(val);
                    c.classList.toggle('border-emerald-500', isActive);
                    c.classList.toggle('bg-emerald-50', isActive);
                    c.classList.toggle('text-emerald-700', isActive);
                });
            }

            function onCustomMontant(val) {
                document.querySelectorAll('.montant-chip').forEach(c => c.classList.remove('border-emerald-500',
                    'bg-emerald-50', 'text-emerald-700'));
                const n = parseInt(val);
                rechargeMontantSelected = (isNaN(n) || n < 10) ? null : n;
                document.getElementById('points-preview').textContent = rechargeMontantSelected ? rechargeMontantSelected +
                    ' pts' : '-- pts';
            }

            function backToMontant() {
                document.getElementById('step-paiement-recharge').classList.add('hidden');
                document.getElementById('step-montant').classList.remove('hidden');
                document.getElementById('recharge-error-2').classList.add('hidden');
            }

            async function initRechargePayment() {
                const errEl = document.getElementById('recharge-error-1');
                errEl.classList.add('hidden');

                if (!rechargeMontantSelected || rechargeMontantSelected < 10) {
                    errEl.textContent = 'Veuillez choisir un montant (minimum 10 DH).';
                    errEl.classList.remove('hidden');
                    return;
                }

                const btn = document.getElementById('btn-recharge-continuer');
                btn.disabled = true;
                btn.textContent = 'Chargement...';

                try {
                    const res = await fetch("{{ route('points.payment-intent') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            montant: rechargeMontantSelected
                        }),
                    });

                    const data = await res.json();

                    if (!res.ok) {
                        errEl.textContent = data.error ?? 'Une erreur est survenue.';
                        errEl.classList.remove('hidden');
                        return;
                    }

                    rechargeClientSecret = data.clientSecret;

                    document.getElementById('recap-recharge').innerHTML =
                        `Rechargement de <strong>${rechargeMontantSelected} DH</strong><br>
                 <span class="font-bold text-emerald-700">+${rechargeMontantSelected} points</span> seront crédités sur votre compte.`;

                    document.getElementById('step-montant').classList.add('hidden');
                    document.getElementById('step-paiement-recharge').classList.remove('hidden');

                } catch (e) {
                    console.error('Fetch error:', e);
                    errEl.textContent = 'Erreur réseau. Réessayez.';
                    errEl.classList.remove('hidden');
                } finally {
                    btn.disabled = false;
                    btn.textContent = 'Continuer →';
                }
            }

            async function payRecharge() {
                const btn = document.getElementById('btn-recharge-payer');
                const label = document.getElementById('btn-recharge-label');
                const errEl = document.getElementById('recharge-error-2');

                btn.disabled = true;
                label.textContent = 'Traitement...';
                errEl.classList.add('hidden');

                const {
                    paymentIntent,
                    error
                } = await rechargeStripe.confirmCardPayment(rechargeClientSecret, {
                    payment_method: {
                        card: rechargeCardElement
                    }
                });

                if (error) {
                    errEl.textContent = error.message;
                    errEl.classList.remove('hidden');
                    btn.disabled = false;
                    label.textContent = 'Payer et recharger';
                    return;
                }

                if (paymentIntent.status === 'succeeded') {
                    label.textContent = 'Confirmation...';
                    try {
                        const res = await fetch("{{ route('points.confirm') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                payment_intent_id: paymentIntent.id
                            }),
                        });

                        const data = await res.json();

                        if (data.success) {
                            // Mettre à jour le solde affiché sans recharger la page
                            document.querySelectorAll('.solde-display').forEach(el => {
                                el.textContent = data.nouveauSolde + ' pts';
                            });

                            closeRechargeModal();

                            // Message de succès temporaire
                            const flash = document.createElement('div');
                            flash.className =
                                'fixed top-5 right-5 bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-lg text-sm font-medium z-50';
                            flash.textContent = `+${data.pointsAjoutes} points ajoutés avec succès !`;
                            document.body.appendChild(flash);
                            setTimeout(() => flash.remove(), 4000);
                        }

                    } catch (e) {
                        errEl.textContent = 'Erreur lors de la confirmation. Contactez le support.';
                        errEl.classList.remove('hidden');
                        btn.disabled = false;
                        label.textContent = 'Payer et recharger';
                    }
                }
            }

            document.getElementById('modal-recharge').addEventListener('click', function(e) {
                if (e.target === this) closeRechargeModal();
            });
        </script>
    @endauth

    <div id="modal-overlay" onclick="closeModal(event)">
        <div id="modal-box" onclick="event.stopPropagation()">
            <div class="flex justify-between items-start mb-5">
                <h3 class="text-lg font-bold text-gray-900">Confirmer votre participation</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="bg-emerald-50 rounded-xl p-4 mb-5 space-y-2">
                <div class="flex gap-2 text-sm">
                    <div>
                        <span class="text-gray-500">Terrain :</span>
                        <strong id="modal-terrain" class="text-gray-800 ml-1"></strong>
                    </div>
                </div>
                <div class="flex gap-2 text-sm">
                    <div>
                        <span class="text-gray-500">Date :</span>
                        <strong id="modal-date" class="text-gray-800 ml-1"></strong>
                    </div>
                </div>
                <div class="flex gap-2 text-sm">
                    <div>
                        <span class="text-gray-500">Places restantes :</span>
                        <strong id="modal-places" class="text-emerald-700 ml-1"></strong>
                    </div>
                </div>
            </div>

            <p class="text-sm text-gray-500 mb-5">En rejoignant ce match, vous vous engagez à être présent. Votre place
                sera confirmée immédiatement.</p>

            <form id="modal-form" method="POST" action="">
                @csrf
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal()"
                        class="flex-1 border border-gray-200 rounded-xl py-2.5 text-sm text-gray-600 hover:bg-gray-50 transition font-medium">
                        Annuler
                    </button>
                    <button type="submit" class="join-btn flex-1 text-center py-2.5">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(annonceId, terrain, date, places) {
            document.getElementById('modal-terrain').textContent = terrain;
            document.getElementById('modal-date').textContent = date;
            document.getElementById('modal-places').textContent = places + (places > 1 ? ' places' : ' place');
            document.getElementById('modal-form').action = `/joueur/annonces/${annonceId}/rejoindre`;
            document.getElementById('modal-overlay').classList.add('open');
        }

        function closeModal(e) {
            if (!e || e.target === document.getElementById('modal-overlay')) {
                document.getElementById('modal-overlay').classList.remove('open');
            }
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</body>

</html>
