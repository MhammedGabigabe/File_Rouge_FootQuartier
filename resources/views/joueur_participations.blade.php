<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes participations | FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Lexend', sans-serif; }
        .nav-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.6rem 1rem; border-radius: 0.5rem;
            color: #374151; font-size: 0.9rem;
            transition: background 0.2s, color 0.2s;
        }
        .nav-link:hover { background: #f0fdf4; color: #059669; }
        .nav-link.active { background: #d1fae5; color: #065f46; font-weight: 600; }
        .card { animation: fadeUp 0.35s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex overflow-hidden h-screen">

    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between fixed h-full z-40">
        <div>
            <div class="p-6 border-b">
                <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                <p class="text-xs text-gray-400 mt-1">Espace Joueur</p>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('joueur.dashboard') }}" class="nav-link {{ request()->routeIs('joueur.dashboard') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Tableau de bord
                </a>
                <a href="{{ route('terrains') }}" class="nav-link {{ request()->routeIs('terrains') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Rechercher un terrain
                </a>
                <a href="{{ route('joueur.reservations') }}" class="nav-link {{ request()->routeIs('joueur.reservations') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Mes réservations
                </a>
                <a href="{{ route('annonces.public') }}" class="nav-link {{ request()->routeIs('annonces.public') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Trouver un match
                </a>
                <a href="{{ route('joueur.participations') }}" class="nav-link {{ request()->routeIs('joueur.participations') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Mes participations
                </a>
                <a href="{{ route('joueur.historique') }}" class="nav-link {{ request()->routeIs('joueur.historique') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Historique
                </a>
                <a href="{{ route('joueur.notifications') }}" class="nav-link {{ request()->routeIs('joueur.notifications') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    Notifications
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>
                @if(Auth::user()->isModerateur())
                    <a href="{{ route('moderator.dashboard') }}" class="nav-link">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Espace Modérateur
                    </a>
                @endif
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Espace Admin
                    </a>
                @endif
            </nav>
        </div>
        <div class="p-4 border-t">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full text-left nav-link text-red-500 hover:bg-red-50 hover:text-red-600">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 ml-64 overflow-y-auto">
        <main class="p-10 ">

            <div class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Mes participations</h2>
                    <p class="text-gray-500 text-sm mt-1">Vos matchs à venir en tant que participant.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">Solde :
                        <span class="text-emerald-600 font-bold">{{ Auth::user()->pointsCompte }} pts</span>
                    </span>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($participations as $participation)
                    @php
                        $annonce = $participation->annonce;
                        $terrain = $annonce->reservation->terrain;
                        $dateDebut = $annonce->reservation->date_debut;
                        $peutSeRetirer = $participation->peutSeRetirer();
                    @endphp

                    <div class="card bg-white rounded-2xl shadow border border-gray-100 p-5 flex flex-col gap-3">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-900 text-base leading-tight">{{ $terrain->nom_terrain }}</h3>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 flex-shrink-0 ml-2">
                                Confirmé
                            </span>
                        </div>

                        <div class="space-y-1.5 text-sm text-gray-500">
                            <p class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $terrain->localisation ?? 'Non précisé' }}
                            </p>
                            <p class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ \Carbon\Carbon::parse($dateDebut)->translatedFormat('D d M Y') }}
                                — {{ \Carbon\Carbon::parse($dateDebut)->format('H:i') }}
                            </p>
                            <p class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Organisé par <strong class="text-gray-700 ml-1">{{ $annonce->organisateur->nom }}</strong>
                            </p>
                            <p class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-semibold text-emerald-600">{{ $participation->points_payes }} pts</span>
                                <span class="text-gray-400">payés</span>
                            </p>
                        </div>

                        <div class="mt-auto pt-2 border-t border-gray-100">
                            @if($peutSeRetirer)
                                <form method="POST" action="{{ route('participations.destroy', $annonce->id) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-sm text-red-500 hover:text-red-700 hover:bg-red-50 border border-red-200 rounded-xl py-2 transition font-medium">
                                        Se retirer du match
                                    </button>
                                </form>
                            @else
                                <p class="text-center text-xs text-gray-400 py-2">
                                    Retrait impossible — moins de 4h avant le match
                                </p>
                            @endif
                        </div>
                    </div>

                @empty
                    <div class="col-span-3 text-center py-20">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-700 text-lg mb-1">Aucune participation</h3>
                        <p class="text-gray-400 text-sm mb-4">Vous n'avez rejoint aucun match pour le moment.</p>
                        <a href="{{ route('annonces.public') }}"
                            class="inline-block bg-emerald-600 text-white text-sm px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition font-medium">
                            Trouver un match
                        </a>
                    </div>
                @endforelse
            </div>

            @if($participations->hasPages())
                <div class="mt-6">
                    {{ $participations->links() }}
                </div>
            @endif

        </main>
    </div>

</body>
</html>