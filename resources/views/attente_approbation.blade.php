<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="w-full h-screen flex justify-center items-center">

        <div class="bg-white p-6 rounded shadow text-center" style="width:400px;">

            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:50px;height:50px;margin:auto;color:green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 style="font-size:22px;font-weight:bold;margin-bottom:10px;">
                Compte en attente
            </h1>

            <p style="font-size:14px;color:gray;">
                Bonjour {{ Auth::user()->nom }},
            </p>

            <p style="font-size:14px;color:gray;margin-top:10px;">
                Votre demande pour devenir Modérateur est envoyée.
            </p>

            <p style="font-size:14px;color:gray;margin-top:10px;">
                Vous devez attendre la validation de l'admin pour continuer.
            </p>

            <form action="{{ route('logout') }}" method="POST" style="margin-top:20px;">
                @csrf
                <button type="submit" style="color:green;text-decoration:underline;">
                    Se déconnecter
                </button>
            </form>

        </div>

    </div>

</body>
</html>