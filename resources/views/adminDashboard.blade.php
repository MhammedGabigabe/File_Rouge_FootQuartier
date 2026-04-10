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
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">

    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold text-emerald-700">Admin Dashboard</h1>

            <div class="flex items-center gap-4">
                <span class="text-sm">
                    {{ Auth::user()->nom }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 text-sm font-semibold">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">

        <div class="grid md:grid-cols-4 gap-6 mb-4">

            <div class="bg-white p-2 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Terrains</p>
                <h2 class="text-3xl font-bold text-emerald-600">{{ $terrainsCount }}</h2>
            </div>

            <div class="bg-white p-2 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Tournois</p>
                <h2 class="text-3xl font-bold text-emerald-600">
                    ##
                </h2>
            </div>

            <div class="bg-white p-2 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Membres</p>
                <h2 class="text-3xl font-bold text-emerald-600">
                    {{ $membersCount }}
                </h2>
            </div>

            <div class="bg-white p-2 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Modérateurs</p>
                <h2 class="text-3xl font-bold text-emerald-600">
                    {{ $moderatorsCount }}
                </h2>
            </div>

        </div>

        <div class="bg-white p-4 rounded-xl shadow mb-4">

            <form method="GET" class="grid md:grid-cols-3 gap-4">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Rechercher nom ou email..."
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400">

                <select name="role"
                    class="w-full px-4 py-2 border rounded-lg bg-white focus:ring-2 focus:ring-emerald-400">

                    <option value="">Tous les rôles</option>
                    <option value="Membre">Membre</option>
                    <option value="Moderateur">Modérateur</option>

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
                        @if($user->roles->contains('titre', 'Moderateur'))
                            
                            @if($user->estApprouve == 0)
                                <form action="{{ route('admin.user.approve', $user->id) }}" method="POST" onsubmit="return confirm('Approuver ce modérateur ?')">
                                    @csrf
                                    <button type="submit" class="text-emerald-600 font-bold hover:underline">
                                        Approuver
                                    </button>
                                </form>
                            
                            @else
                                <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="{{ $user->estActif ? 'text-red-600' : 'text-emerald-600' }} font-bold hover:underline">
                                        {{ $user->estActif ? 'Bannir' : 'Débannir' }}
                                    </button>
                                </form>
                            @endif

                        @elseif($user->roles->contains('titre', 'Membre'))
                            <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="{{ $user->estActif ? 'text-red-600' : 'text-emerald-600' }} font-bold hover:underline">
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

</body>

</html>
