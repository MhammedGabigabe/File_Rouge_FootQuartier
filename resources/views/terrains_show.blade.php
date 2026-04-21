<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $terrain->nom_terrain }} - FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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

        #map {
            height: 100%;
            width: 100%;
            min-height: 320px;
            border-radius: 0 1rem 1rem 0;
            z-index: 0;
        }

        .badge-equip {
            display: inline-flex;
            align-items: center;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 999px;
            background: #f0fdf4;
            color: #065f46;
            border: 1px solid #a7f3d0;
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
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen overflow-hidden @auth flex @endauth">

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
                    <a href="{{ route('terrains') }}" class="sidebar-nav-link active">
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
                    @if (Auth::user()->isModerateur())
                        <a href="{{ route('moderator.dashboard') }}" class="sidebar-nav-link">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Espace Modérateur
                        </a>
                    @endif

                    @if (Auth::user()->isAdmin())
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
            <div class="p-4 border-t">
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
        <nav class="fixed top-0 w-full bg-white shadow-sm z-50 mb-6">
            <div class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">
                <a href="{{ route('accueil') }}">
                    <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                </a>
                <div class="hidden md:flex gap-8 text-sm">
                    <a href="{{ route('accueil') }}" class="text-gray-600 hover:text-emerald-600">Accueil</a>
                    <a href="{{ route('terrains') }}" class="text-emerald-600 font-semibold">Terrains</a>
                    <a href="{{ route('annonces') }}" class="text-gray-600 hover:text-emerald-600">Matchs</a>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm text-gray-700 hover:text-emerald-600 font-medium">Se connecter</a>
                    <a href="{{ route('inscription') }}"
                        class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 font-medium">S'inscrire</a>
                </div>
            </div>
        </nav>
    @endguest

    <div class="flex-1 min-w-0 @auth ml-64 mt-10 p-2 @endauth @guest pt-24 @endguest">
        <main class="p-2 pb-16 max-w-5xl mx-auto ">

            <a href="{{ route('terrains') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-emerald-600 mb-4 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Retour aux terrains
            </a>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="flex flex-col lg:flex-row gap-6">

                    <div class="flex-1 flex flex-col">

                        <div class="relative">
                            @if ($terrain->photo)
                                <img src="{{ asset('storage/' . $terrain->photo) }}"
                                    alt="{{ $terrain->nom_terrain }}" class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-emerald-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                            @endif
                            <span
                                class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                                {{ $terrain->capacite }}v{{ $terrain->capacite }}
                            </span>
                            <span
                                class="absolute top-3 right-3 bg-emerald-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                                {{ $terrain->prix }} DH/h
                            </span>
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex justify-between items-start gap-4 mb-2">
                                <div>
                                    <h2 class="text-xl font-bold">{{ $terrain->nom_terrain }}</h2>
                                    <div class="flex items-center gap-1 text-gray-400 text-sm mt-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        {{ $terrain->localisation }}
                                    </div>
                                </div>
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full flex-shrink-0
                                    {{ $terrain->statut === 'actif' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $terrain->statut }}
                                </span>
                            </div>

                            @php $rating = round($terrain->avis_avg_note ?? 0); @endphp
                            <div class="flex items-center gap-1 mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $rating ? 'text-amber-400' : 'text-gray-200' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>

                            @if ($terrain->description_terr)
                                <p class="text-sm text-gray-600 leading-relaxed mb-3">{{ $terrain->description_terr }}
                                </p>
                            @endif

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
                            @if (count($equips) > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($equips as $eq)
                                        @php $eq = is_array($eq) ? $eq[0] : $eq; @endphp
                                        <span
                                            class="badge-equip">{{ $equipsLabels[$eq] ?? ucfirst(str_replace('_', ' ', $eq)) }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-auto pt-3 border-t border-gray-100">
                                @auth
                                    <a href="#"
                                        class="block w-full text-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-medium text-sm">
                                        Réserver ce terrain
                                    </a>
                                @else
                                    <a href="{{ route('login', ['redirect' => route('terrains.show', $terrain->id)]) }}"
                                        class="block w-full text-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition font-medium text-sm">
                                        Connectez-vous pour réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    @if ($terrain->latitude && $terrain->longitude)
                        <div class="lg:w-96 min-h-80 border-t lg:border-t-0 lg:border-l border-gray-100">
                            <div id="map" class="w-full h-full min-h-80"></div>
                        </div>
                    @endif

                </div>
            </div>

        </main>
    </div>

    @if ($terrain->latitude && $terrain->longitude)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const lat = {{ $terrain->latitude }};
                const lng = {{ $terrain->longitude }};

                const map = L.map('map', {
                    scrollWheelZoom: false
                }).setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                const icon = L.divIcon({
                    className: '',
                    html: `<div style="width:36px;height:36px;background:#059669;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.3)"></div>`,
                    iconSize: [36, 36],
                    iconAnchor: [18, 36],
                });

                L.marker([lat, lng], {
                        icon
                    })
                    .addTo(map)
                    .bindPopup(`<strong>{{ $terrain->nom_terrain }}</strong><br>{{ $terrain->localisation }}`)
                    .openPopup();
            });
        </script>
    @endif

</body>

</html>
