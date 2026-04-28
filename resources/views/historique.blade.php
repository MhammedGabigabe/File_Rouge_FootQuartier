<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique | FootQuartier</title>
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

                <a href="{{ route('terrains') }}"
                    class="nav-link {{ request()->routeIs('terrains') ? 'active' : '' }}">
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

                <a href="{{ route('joueur.annonces') }}"
                    class="nav-link {{ request()->routeIs('annonces') ? 'active' : '' }}">
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
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>

                @php
                    $roleMod = Auth::user()->isModerateur();
                    $roleAdmin = Auth::user()->isAdmin();
                @endphp

                @if($roleMod)
                    <a href="{{ route('moderator.dashboard') }}" class="nav-link w-full">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Espace Modérateur
                    </a>
                @endif

                @if($roleAdmin)
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

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Historique</h2>
                <p class="text-sm text-gray-400 mt-1">Recharges et réservations — toutes vos transactions</p>
            </div>

            <form method="GET" action="{{ route('joueur.historique') }}" class="flex flex-wrap gap-3 mb-6">
                <select name="type"
                    onchange="this.form.submit()"
                    class="text-sm border border-gray-200 rounded-xl px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                    <option value="">Tous les types</option>
                    <option value="recharge" {{ request('type') === 'recharge' ? 'selected' : '' }}>Recharges</option>
                    <option value="paiement_reservation"
                        {{ request('type') === 'paiement_reservation' ? 'selected' : '' }}>Réservations</option>
                    <option value="remboursement"
                        {{ request('type') === 'remboursement' ? 'selected' : '' }}>Remboursements</option>
                </select>
            </form>

            {{-- Tableau --}}
            <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">

                @if($transactions->isEmpty())
                    <div class="text-center py-16 text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-sm">Aucune transaction trouvée.</p>
                    </div>
                @else
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th
                                    class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th
                                    class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Détail</th>
                                <th
                                    class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Référence</th>
                                <th
                                    class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Montant</th>
                                <th
                                    class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Points</th>
                                <th
                                    class="text-center px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($transactions as $tx)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-5 py-4 text-gray-500 whitespace-nowrap">
                                        <span class="block">{{ $tx->created_at->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-300">{{ $tx->created_at->format('H:i') }}</span>
                                    </td>

                                    <td class="px-5 py-4">
                                        @php
                                            $typeConfig = [
                                                'recharge'             => ['label' => 'Recharge',      'class' => 'bg-blue-50 text-blue-600'],
                                                'paiement_reservation' => ['label' => 'Réservation',   'class' => 'bg-emerald-50 text-emerald-600'],
                                                'transfert_points'     => ['label' => 'Transfert',     'class' => 'bg-purple-50 text-purple-600'],
                                                'remboursement'        => ['label' => 'Remboursement', 'class' => 'bg-amber-50 text-amber-600'],
                                            ];
                                            $cfg = $typeConfig[$tx->type] ?? ['label' => $tx->type, 'class' => 'bg-gray-50 text-gray-500'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $cfg['class'] }}">
                                            {{ $cfg['label'] }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 text-gray-600">
                                        @if($tx->type === 'paiement_reservation' && $tx->transactionnable)
                                            @php $res = $tx->transactionnable; @endphp
                                            <span class="block font-medium">{{ $res->terrain->nom ?? 'Terrain' }}</span>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($res->date_debut)->format('d/m H:i') }}
                                                → {{ \Carbon\Carbon::parse($res->date_fin)->format('H:i') }}
                                            </span>
                                        @elseif($tx->type === 'recharge')
                                            <span class="text-gray-500">Recharge de compte</span>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-gray-400 font-mono text-xs">
                                        {{ $tx->reference ?? '—' }}
                                    </td>

                                    <td class="px-5 py-4 text-right font-semibold">
                                        @if($tx->montant > 0)
                                            @php $isCredit = in_array($tx->type, ['recharge', 'remboursement']); @endphp
                                            <span class="{{ $isCredit ? 'text-emerald-600' : 'text-gray-700' }}">
                                                {{ $isCredit ? '+' : '-' }}{{ number_format($tx->montant, 2) }} DH
                                            </span>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-right">
                                        @if($tx->points != 0)
                                            <span
                                                class="{{ $tx->points > 0 ? 'text-emerald-500' : 'text-red-400' }} font-medium">
                                                {{ $tx->points > 0 ? '+' : '' }}{{ $tx->points }} pts
                                            </span>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-center">
                                        @php
                                            $statutConfig = [
                                                'reussi'    => ['label' => 'Réussi',    'class' => 'bg-emerald-50 text-emerald-600'],
                                                'echoue'    => ['label' => 'Échoué',    'class' => 'bg-red-50 text-red-500'],
                                                'rembourse' => ['label' => 'Remboursé', 'class' => 'bg-amber-50 text-amber-500'],
                                            ];
                                            $sc = $statutConfig[$tx->statut] ?? ['label' => $tx->statut, 'class' => 'bg-gray-50 text-gray-400'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sc['class'] }}">
                                            {{ $sc['label'] }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($transactions->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100">
                            {{ $transactions->appends(request()->query())->links() }}
                        </div>
                    @endif
                @endif

            </div>

        </main>
    </div>

</body>

</html>