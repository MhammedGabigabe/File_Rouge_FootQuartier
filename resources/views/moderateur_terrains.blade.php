<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Terrains | FootQuartier</title>
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

        .terrain-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .terrain-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(5, 150, 105, 0.1);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 50;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex">

    {{-- ── SIDEBAR ── --}}
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between fixed h-full z-40">
        <div class="overflow-y-auto flex-1">
            <div class="p-6 border-b">
                <a href="{{ route('accueil') }}">
                    <h1 class="text-xl font-bold text-emerald-700">FootQuartier</h1>
                </a>
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

                <a href="{{ route('moderateur.terrains.index') }}"
                    class="nav-link {{ request()->routeIs('moderateur.terrains*') ? 'active' : '' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Mes terrains
                </a>

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

                <a href="{{ route('joueur.dashboard') }}" class="nav-link">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Espace joueur
                </a>
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

    {{-- ── CONTENU ── --}}
    <div class="flex-1 ml-64">
        <main class="p-6">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Mes terrains</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ $terrains->count() }} terrain(s) enregistré(s)</p>
                </div>
                <button onclick="openModal('modal-add')"
                    class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajouter un terrain
                </button>
            </div>

            {{-- Messages --}}
            @if (session('success'))
                <div
                    class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Cards terrains --}}
            @if ($terrains->isEmpty())
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg font-medium">Aucun terrain pour le moment</p>
                    <p class="text-gray-400 text-sm mt-1">Cliquez sur "Ajouter un terrain" pour commencer</p>
                </div>
            @else
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach ($terrains as $terrain)
                        <div class="terrain-card bg-white rounded-2xl shadow overflow-hidden border border-gray-100">

                            {{-- Photo --}}
                            @if ($terrain->photo)
                                <img src="{{ asset('storage/' . $terrain->photo) }}"
                                    alt="{{ $terrain->nom_terrain }}" class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-emerald-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-4">
                                {{-- Nom + statut --}}
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-base">{{ $terrain->nom_terrain }}</h3>
                                    <span
                                        class="text-xs px-2 py-0.5 rounded-full flex-shrink-0
                                        {{ $terrain->statut === 'actif' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $terrain->statut }}
                                    </span>
                                </div>

                                <p class="text-sm text-gray-500 mb-1">📍 {{ $terrain->localisation }}</p>
                                <p class="text-sm text-gray-500 mb-3">
                                    ⚽ {{ $terrain->capacite }}v{{ $terrain->capacite }} &nbsp;·&nbsp;
                                    <span class="text-emerald-600 font-bold">{{ $terrain->prix }} DH</span>
                                </p>

                                {{-- Équipements --}}
                                @if ($terrain->equipements->count() > 0)
                                    <div class="flex flex-wrap gap-1 mb-4">
                                        @foreach ($terrain->equipements->take(3) as $eq)
                                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">
                                                {{ $eq->nom }}
                                            </span>
                                        @endforeach
                                        @if ($terrain->equipements->count() > 3)
                                            <span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full">
                                                +{{ $terrain->equipements->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Actions --}}
                                <div class="flex gap-2">
                                    <button
                                        onclick="openEditModal({{ $terrain->id }}, '{{ addslashes($terrain->nom_terrain) }}', '{{ addslashes($terrain->localisation) }}', {{ $terrain->prix }}, {{ $terrain->capacite }}, '{{ $terrain->statut }}', '{{ addslashes($terrain->description_terr ?? '') }}')"
                                        class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-sm font-medium hover:bg-emerald-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Modifier
                                    </button>

                                    <form action="{{ route('moderateur.terrains.destroy', $terrain->id) }}"
                                        method="POST" onsubmit="return confirm('Supprimer ce terrain ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-medium hover:bg-red-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </main>
    </div>

    {{-- ══════════════════════════════════════
         POPUP — AJOUTER UN TERRAIN
    ══════════════════════════════════════ --}}
    <div id="modal-add" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-add')">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">

            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-gray-800">Ajouter un terrain</h3>
                <button onclick="closeModal('modal-add')" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('moderateur.terrains.store') }}" method="POST" enctype="multipart/form-data"
                class="px-6 py-5 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom du terrain</label>
                    <input type="text" name="nom_terrain" value="{{ old('nom_terrain') }}"
                        placeholder="ex: Atlas Sport 5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                    @error('nom_terrain')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                    <input type="text" name="localisation" value="{{ old('localisation') }}"
                        placeholder="ex: Hay Salam, Marrakech"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                    @error('localisation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (DH)</label>
                        <input type="number" name="prix" value="{{ old('prix') }}" min="0"
                            step="0.01" placeholder="200"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                        @error('prix')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Capacité</label>
                        <select name="capacite"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                            <option value="">Choisir</option>
                            <option value="5" {{ old('capacite') == 5 ? 'selected' : '' }}>5v5</option>
                            <option value="7" {{ old('capacite') == 7 ? 'selected' : '' }}>7v7</option>
                            <option value="11" {{ old('capacite') == 11 ? 'selected' : '' }}>11v11</option>
                        </select>
                        @error('capacite')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description_terr" rows="2" placeholder="Décrivez votre terrain..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none resize-none">{{ old('description_terr') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Équipements</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($equipements as $eq)
                            <label class="flex items-center gap-1.5 text-sm cursor-pointer">
                                <input type="checkbox" name="equipements[]" value="{{ $eq->id }}"
                                    {{ in_array($eq->id, old('equipements', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-emerald-600 rounded">
                                {{ $eq->nom }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                    <input type="file" name="photo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('modal-add')"
                        class="flex-1 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         POPUP — MODIFIER UN TERRAIN
    ══════════════════════════════════════ --}}
    <div id="modal-edit" class="modal-overlay" onclick="closeOnOverlay(event, 'modal-edit')">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">

            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h3 class="font-bold text-lg text-gray-800">Modifier le terrain</h3>
                <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="form-edit" action="" method="POST" enctype="multipart/form-data"
                class="px-6 py-5 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom du terrain</label>
                    <input type="text" name="nom_terrain" id="edit-nom"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                    <input type="text" name="localisation" id="edit-localisation"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (DH)</label>
                        <input type="number" name="prix" id="edit-prix" min="0" step="0.01"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Capacité</label>
                        <select name="capacite" id="edit-capacite"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                            <option value="5">5v5</option>
                            <option value="7">7v7</option>
                            <option value="11">11v11</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="statut" id="edit-statut"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description_terr" id="edit-description" rows="2"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Équipements</label>
                    <div class="flex flex-wrap gap-2" id="edit-equipements">
                        @foreach ($equipements as $eq)
                            <label class="flex items-center gap-1.5 text-sm cursor-pointer">
                                <input type="checkbox" name="equipements[]" value="{{ $eq->id }}"
                                    class="edit-eq w-4 h-4 text-emerald-600 rounded" data-id="{{ $eq->id }}">
                                {{ $eq->nom }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouvelle photo (optionnel)</label>
                    <input type="file" name="photo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('modal-edit')"
                        class="flex-1 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        function closeOnOverlay(event, id) {
            if (event.target === document.getElementById(id)) closeModal(id);
        }

        function openEditModal(id, nom, localisation, prix, capacite, statut, description, equipementIds) {
            document.getElementById('form-edit').action = '/moderateur/terrains/' + id;
            document.getElementById('edit-nom').value = nom;
            document.getElementById('edit-localisation').value = localisation;
            document.getElementById('edit-prix').value = prix;
            document.getElementById('edit-capacite').value = capacite;
            document.getElementById('edit-statut').value = statut;
            document.getElementById('edit-description').value = description;

            // Reset équipements
            document.querySelectorAll('.edit-eq').forEach(cb => cb.checked = false);

            openModal('modal-edit');
        }

        // Ouvrir modal add si erreur de validation
        @if ($errors->any() && old('_token'))
            openModal('modal-add');
        @endif
    </script>

</body>

</html>
