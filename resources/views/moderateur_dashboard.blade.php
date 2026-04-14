<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Modérateur | FootQuartier</title>
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
            cursor: pointer;
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

        .sub-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 1rem 0.45rem 2.5rem;
            border-radius: 0.5rem;
            color: #6b7280;
            font-size: 0.82rem;
            transition: background 0.2s, color 0.2s;
        }

        .sub-link:hover {
            background: #f0fdf4;
            color: #059669;
        }

        .sub-link.active {
            color: #065f46;
            font-weight: 600;
            background: #ecfdf5;
        }

        .submenu {
            overflow: hidden;
            transition: max-height 0.3s ease;
            max-height: 0;
        }

        .submenu.open {
            max-height: 300px;
        }

        .chevron {
            transition: transform 0.3s;
            margin-left: auto;
        }

        .chevron.open {
            transform: rotate(180deg);
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
        <div class="overflow-y-auto flex-1">

            <div class="p-6 border-b">
                <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                <p class="text-xs text-gray-400 mt-1">Espace Modérateur</p>
            </div>

            <nav class="p-3 space-y-0.5">

                <a href="{{ route('moderator.dashboard') }}"
                    class="nav-link {{ request()->routeIs('moderator.dashboard') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Tableau de bord
                </a>

                <div>
                    <button onclick="toggleTerrains()"
                        class="nav-link w-full {{ request()->routeIs('moderateur.terrains*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Mes terrains
                        <svg id="chevron-terrains"
                            class="w-3.5 h-3.5 chevron {{ request()->routeIs('moderateur.terrains*') ? 'open' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="submenu-terrains"
                        class="submenu {{ request()->routeIs('moderateur.terrains*') ? 'open' : '' }}">
                        <a href="{{ route('moderateur.terrains.index') }}"
                            class="sub-link {{ request()->routeIs('moderateur.terrains.index') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 flex-shrink-0"></span>
                            Liste des terrains
                        </a>
                        <a href="{{ route('moderateur.terrains.create') }}"
                            class="sub-link {{ request()->routeIs('moderateur.terrains.create') ? 'active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 flex-shrink-0"></span>
                            Ajouter un terrain
                        </a>
                    </div>
                </div>

                <a href="{{ route('moderateur.reservations') }}"
                    class="nav-link {{ request()->routeIs('moderateur.reservations') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Réservations
                </a>

                <a href="{{ route('moderateur.blocages') }}"
                    class="nav-link {{ request()->routeIs('moderateur.blocages') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                    Joueurs bloqués
                </a>

                <a href="{{ route('moderateur.avis') }}"
                    class="nav-link {{ request()->routeIs('moderateur.avis') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    Avis clients
                </a>

                <a href="{{ route('moderateur.paiements') }}"
                    class="nav-link {{ request()->routeIs('moderateur.paiements') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Paiements reçus
                </a>

                <div>
                    <a href="{{ route('joueur.dashboard') }}"
                        class="nav-link w-full">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Espace joueur
                    </a>

                </div>

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

            <div class="grid md:grid-cols-4 gap-5 mb-8">
                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Mes terrains</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $terrainsCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Terrains actifs</p>
                </div>
                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Réservations</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $reservationsCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total confirmées</p>
                </div>
                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Revenus du mois</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $revenusMonth }} DH</p>
                    <p class="text-xs text-gray-400 mt-1">90% des réservations</p>
                </div>
                <div class="stat-card bg-white rounded-2xl shadow p-5 border border-gray-100">
                    <p class="text-sm text-gray-500 mb-1">Avis clients</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $avisCount }}</p>
                    <p class="text-xs text-gray-400 mt-1">Note moy. {{ $noteMoyenne }}/5</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Dernières réservations</h3>
                        <a href="{{ route('moderateur.reservations') }}"
                            class="text-emerald-600 text-sm hover:underline">Voir tout →</a>
                    </div>

                    @forelse($dernieresReservations as $reservation)
                        <div class="flex items-center justify-between py-3 border-b last:border-0">
                            <div>
                                <p class="font-semibold text-sm">{{ $reservation->user->nom }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->terrain->nom_terrain }}</p>
                                <p class="text-xs text-gray-400">
                                    📅 {{ $reservation->date_debut->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-emerald-600">
                                    {{ number_format($reservation->montant * 0.9, 2) }} DH
                                </p>
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full
                                    {{ $reservation->statut === 'confirmee' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $reservation->statut }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm text-center py-4">Aucune réservation.</p>
                    @endforelse
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Derniers avis</h3>
                        <a href="{{ route('moderateur.avis') }}"
                            class="text-emerald-600 text-sm hover:underline">Voir tout →</a>
                    </div>

                    @forelse($derniersAvis as $avis)
                        <div class="py-3 border-b last:border-0">
                            <div class="flex justify-between items-start mb-1">
                                <p class="font-semibold text-sm">{{ $avis->joueur->nom }}</p>
                                <div class="flex gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-3.5 h-3.5 {{ $i <= $avis->note ? 'text-yellow-400' : 'text-gray-200' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">{{ $avis->terrain->nom_terrain }}</p>
                            @if ($avis->commentaire)
                                <p class="text-xs text-gray-600 mt-1 italic">
                                    "{{ Str::limit($avis->commentaire, 60) }}"</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm text-center py-4">Aucun avis pour le moment.</p>
                    @endforelse
                </div>

            </div>

        </main>
    </div>

    <script>
        function toggleTerrains() {
            document.getElementById('submenu-terrains').classList.toggle('open');
            document.getElementById('chevron-terrains').classList.toggle('open');
        }
    </script>

</body>

</html>
