<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | FootQuartier</title>
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

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(5, 150, 105, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex">

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

                <a href="#route('annonces')" class="nav-link {{ request()->routeIs('annonces') ? 'active' : '' }}">
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

                <a href="{{ route('joueur.points') }}"
                    class="nav-link {{ request()->routeIs('joueur.points') ? 'active' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Mes points
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
                @php
                    $roleMod = Auth::user()->isModerateur();
                    $roleAdmin = Auth::user()->isAdmin();
                @endphp
                @if ($roleMod)
                    <a href="{{ route('moderator.dashboard') }}" class="nav-link w-full">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Espace Modérateur
                    </a>
                @endif

                @if ($roleAdmin)
                    <a href="{{ route('admin.dashboard') }}" class="nav-link w-full">
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

    <div class="flex-1 ml-64">


        <main class="p-6">

            <div class="flex justify-end mb-10">
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
            <div class="grid md:grid-cols-4 gap-5 mb-8">

                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Mes points</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ Auth::user()->pointsCompte }}</p>
                    <p class="text-xs text-gray-400 mt-1">1 point = 1 DH</p>
                </div>

                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Réservations</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $reservationsCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total confirmées</p>
                </div>

                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Participations</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $participationsCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Matchs rejoints</p>
                </div>

                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Notifications</p>
                    <p class="text-3xl font-bold text-emerald-600">
                        {{ Auth::user()->unreadNotifications->count() }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">Non lues</p>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg">Notifications récentes</h3>
                    <a href="{{ route('joueur.notifications') }}" class="text-emerald-600 text-sm hover:underline">
                        Voir tout →
                    </a>
                </div>

                @forelse(Auth::user()->notifications->take(5) as $notification)
                    <div
                        class="flex items-start gap-3 py-3 border-b last:border-0 {{ is_null($notification->read_at) ? 'bg-emerald-50 -mx-2 px-2 rounded-lg' : '' }}">
                        <div
                            class="w-2 h-2 rounded-full mt-2 flex-shrink-0 {{ is_null($notification->read_at) ? 'bg-emerald-500' : 'bg-gray-300' }}">
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-700">
                                {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm text-center py-4">Aucune notification.</p>
                @endforelse
            </div>

        </main>
    </div>

</body>

</html>
