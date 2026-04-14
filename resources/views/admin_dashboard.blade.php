<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | FootQuartier</title>

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

    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">

        <div>
            <div class="p-6 border-b">
                <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
            </div>

            <nav class="p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Tableau de bord
                </a>

                <div>
                    <button onclick="toggleJoueur()"
                        class="nav-link w-full {{ request()->routeIs('joueur.*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Espace joueur
                        <svg id="chevron-joueur"
                            class="w-3.5 h-3.5 chevron {{ request()->routeIs('joueur.*') ? 'open' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="submenu-joueur" class="submenu {{ request()->routeIs('joueur.*') ? 'open' : '' }}">
                        <a href="{{ route('terrains') }}" class="sub-link">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Réserver un terrain
                        </a>
                        <a href="{{ route('annonces') }}" class="sub-link">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Trouver un match
                        </a>
                        <a href="{{ route('joueur.points') }}" class="sub-link">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Mes points
                        </a>
                    </div>
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
    <div class="flex-1">

        <main class="max-w-6xl mx-auto p-6">

            <div class="grid md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-2 rounded-xl shadow">
                    <p class="text-gray-500 text-sm">Terrains</p>
                    <h2 class="text-3xl font-bold text-emerald-600">{{ $terrainsCount }}</h2>
                </div>

                <div class="bg-white p-2 rounded-xl shadow">
                    <p class="text-gray-500 text-sm">Membres</p>
                    <h2 class="text-3xl font-bold text-emerald-600">
                        {{ $joueursCount }}
                    </h2>
                </div>

                <div class="bg-white p-2 rounded-xl shadow">
                    <p class="text-gray-500 text-sm">Modérateurs</p>
                    <h2 class="text-3xl font-bold text-emerald-600">
                        {{ $moderatorsCount }}
                    </h2>
                </div>

            </div>

            <div class="bg-white p-4 rounded-xl shadow mb-6">

                <form method="GET" action="{{ route('admin.user.search') }}" class="grid md:grid-cols-3 gap-4">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Rechercher nom ou email..."
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400">

                    <select name="role"
                        class="w-full px-4 py-2 border rounded-lg bg-white focus:ring-2 focus:ring-emerald-400">

                        <option value="">Tous les rôles</option>
                        <option value="joueur" {{ request('role') == 'joueur' ? 'selected' : '' }}>Joueur</option>
                        <option value="moderateur" {{ request('role') == 'moderateur' ? 'selected' : '' }}>Modérateur
                        </option>

                    </select>

                    <button class="bg-emerald-600 text-white rounded-lg px-4 py-2 hover:bg-emerald-700">
                        Rechercher
                    </button>

                </form>

            </div>

            <div class="bg-white rounded-xl shadow p-4">

                <h2 class="text-xl font-bold mb-2">Liste des utilisateurs</h2>

                <table class="w-full text-sm text-left">

                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($users as $user)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="py-2">{{ $user->nom }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    <span class="px-2 py-1 text-xs rounded bg-emerald-100 text-emerald-700">
                                        {{ $user->roles->first()->titre ?? '—' }}
                                    </span>
                                </td>

                                <td class="flex items-center gap-3 py-2">
                                    @if ($user->roles->contains('titre', 'moderateur'))
                                        @if ($user->estApprouve == 0)
                                            <form action="{{ route('admin.user.approve', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Approuver ce modérateur ?')">
                                                @csrf
                                                <button type="submit"
                                                    class="text-emerald-600 font-bold hover:underline">
                                                    Approuver
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.user.toggle', $user->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="{{ $user->estActif ? 'text-red-600' : 'text-emerald-600' }} font-bold hover:underline">
                                                    {{ $user->estActif ? 'Bannir' : 'Débannir' }}
                                                </button>
                                            </form>
                                        @endif
                                    @elseif($user->roles->contains('titre', 'joueur'))
                                        <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $user->estActif ? 'text-red-600' : 'text-emerald-600' }} font-bold hover:underline">
                                                {{ $user->estActif ? 'Bannir' : 'Débannir' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleJoueur() {
            document.getElementById('submenu-joueur').classList.toggle('open');
            document.getElementById('chevron-joueur').classList.toggle('open');
        }
    </script>
</body>

</html>
