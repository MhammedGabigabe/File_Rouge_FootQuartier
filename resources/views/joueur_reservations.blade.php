<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations | FootQuartier</title>
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex overflow-hidden">

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

            <div class="mb-3">
                <h2 class="text-2xl font-bold text-gray-800">Mes réservations</h2>
                <p class="text-sm text-gray-400 mt-1">Gérez vos créneaux et publiez des annonces de match</p>
            </div>

            @if (session('success'))
                <div
                    class="mb-5 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->has('reservation_id'))
                <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl">
                    {{ $errors->first('reservation_id') }}
                </div>
            @endif

            @if ($reservations->isEmpty())
                <div class="bg-white rounded-2xl shadow border border-gray-100 text-center py-16 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm">Aucune réservation pour le moment.</p>
                    <a href="{{ route('terrains') }}"
                        class="inline-block mt-4 px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">
                        Réserver un terrain
                    </a>
                </div>
            @else
                <div class="grid gap-1">
                    @foreach ($reservations as $reservation)
                        <div class="bg-white rounded-2xl shadow border border-gray-100 p-4">

                            <div class="flex items-start justify-between">

                                <div class="flex items-start">

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $reservation->terrain->nom_terrain }}</p>
                                        <p class="text-sm text-gray-400 mt-0.5">
                                            {{ $reservation->terrain->localisation }}
                                        </p>
                                        <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">
                                            <span>
                                                {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                                            </span>
                                            <span>
                                                {{ \Carbon\Carbon::parse($reservation->date_debut)->format('H:i') }}
                                                → {{ \Carbon\Carbon::parse($reservation->date_fin)->format('H:i') }}
                                            </span>
                                            <span>{{ number_format($reservation->montant, 2) }} DH</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    @php
                                        $statutConfig = [
                                            'confirmee' => [
                                                'label' => 'Confirmée',
                                                'class' => 'bg-emerald-50 text-emerald-600',
                                            ],
                                            'en_attente' => [
                                                'label' => 'En attente',
                                                'class' => 'bg-amber-50 text-amber-600',
                                            ],
                                            'expiree' => ['label' => 'Expirée', 'class' => 'bg-gray-100 text-gray-400'],
                                        ];
                                        $sc = $statutConfig[$reservation->statut] ?? [
                                            'label' => $reservation->statut,
                                            'class' => 'bg-gray-50 text-gray-400',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sc['class'] }}">
                                        {{ $sc['label'] }}
                                    </span>
                                </div>

                            </div>

                            <div class="border-t border-gray-50">

                                @if (!$reservation->annonce && $reservation->statut === 'confirmee' && $reservation->date_debut > now())
                                    <form method="POST" action="{{ route('annonces.store') }}">
                                        @csrf
                                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                        <div class="flex items-center gap-3 flex-wrap">
                                            <label class="text-sm text-gray-500">
                                                Publier une annonce de match
                                            </label> <select name="places_total"
                                                class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
                                                @for ($i = 1; $i <= $reservation->terrain->capacite * 2; $i++)
                                                    <option value="{{ $i }}">{{ $i }}
                                                        joueur{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>
                                            <button type="submit"
                                                class="px-4 py-1.5 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">
                                                Publier
                                            </button>
                                        </div>
                                    </form>
                                @elseif($reservation->annonce)
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0"></span>
                                        <p class="text-sm text-emerald-600 font-medium">
                                            Annonce publiée —
                                            {{ $reservation->annonce->places_dispo }} place(s) disponible(s) sur
                                            {{ $reservation->annonce->places_total }}
                                        </p>
                                        @if ($reservation->annonce->statut === 'complete')
                                            <span
                                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                                Complet
                                            </span>
                                        @endif
                                    </div>
                                @elseif($reservation->statut === 'confirmee' && $reservation->date_debut <= now())
                                    <p class="text-sm text-gray-400">Ce créneau est déjà passé.</p>
                                @elseif($reservation->statut !== 'confirmee')
                                    <p class="text-sm text-gray-400">La réservation doit être confirmée pour publier
                                        une annonce.</p>
                                @endif

                            </div>

                        </div>
                    @endforeach
                </div>

                @if ($reservations->hasPages())
                    <div class="mt-6">
                        {{ $reservations->links() }}
                    </div>
                @endif

            @endif

        </main>
    </div>

</body>

</html>
