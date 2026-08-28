<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connexion admin</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
    <p class="font-bold text-lg mb-1">Miriam<span class="text-indigo-600">.</span></p>
    <h1 class="text-xl font-bold mb-6">Connexion administration</h1>

    @if($errors->any())
      <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium mb-1">E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Mot de passe</label>
        <input type="password" name="password" required
               class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <button type="submit" class="w-full rounded-lg bg-slate-900 text-white font-semibold py-2.5 hover:bg-indigo-600 transition">
        Se connecter
      </button>
    </form>
    <a href="{{ route('home') }}" class="block text-center text-sm text-slate-500 mt-6 hover:text-slate-800">← Retour au site</a>
  </div>
</body>
</html>
