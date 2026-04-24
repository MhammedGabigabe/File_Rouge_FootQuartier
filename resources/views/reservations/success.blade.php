<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation confirmée - FootQuartier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2 { font-family: 'Lexend', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 max-w-md w-full p-8 text-center">

        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-1">Réservation confirmée !</h1>
        <p class="text-gray-400 text-sm mb-6">Votre paiement a été accepté avec succès.</p>

        <div class="bg-gray-50 rounded-xl p-4 text-left space-y-3 mb-6">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Terrain</span>
                <span class="font-semibold text-gray-800">{{ $reservation->terrain->nom_terrain }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Date</span>
                <span class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                </span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Horaire</span>
                <span class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($reservation->date_debut)->format('H:i') }}
                    →
                    {{ \Carbon\Carbon::parse($reservation->date_fin)->format('H:i') }}
                </span>
            </div>
            <div class="border-t border-gray-200 pt-3 flex justify-between text-sm">
                <span class="text-gray-500">Montant payé</span>
                <span class="font-bold text-emerald-600">{{ $reservation->montant }} DH</span>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <a href="{{ route('joueur.reservations') }}"
                class="w-full py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition text-sm font-medium">
                Voir mes réservations
            </a>
            <a href="{{ route('terrains') }}"
                class="w-full py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition text-sm font-medium">
                Retour aux terrains
            </a>
        </div>

    </div>

</body>
</html>