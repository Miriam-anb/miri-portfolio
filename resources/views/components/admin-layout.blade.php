<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'Admin' }} — Espace administration</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
<div class="flex min-h-screen">
  <aside class="w-64 bg-ink bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
    <div class="px-6 py-6 border-b border-white/10">
      <p class="font-bold text-lg">Miriam<span class="text-indigo-400">.</span></p>
      <p class="text-xs text-slate-400 mt-1">Espace administration</p>
    </div>
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
      <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 font-semibold' : '' }}">Tableau de bord</a>
      <a href="{{ route('admin.settings.edit') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.settings.*') ? 'bg-white/10 font-semibold' : '' }}">Paramètres du site</a>
      <a href="{{ route('admin.services.index') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.services.*') ? 'bg-white/10 font-semibold' : '' }}">Services</a>
      <a href="{{ route('admin.projects.index') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.projects.*') ? 'bg-white/10 font-semibold' : '' }}">Projets</a>
      <a href="{{ route('admin.messages.index') }}" class="block rounded-lg px-3 py-2 hover:bg-white/10 {{ request()->routeIs('admin.messages.*') ? 'bg-white/10 font-semibold' : '' }}">Messages</a>
      <a href="{{ route('home') }}" target="_blank" class="block rounded-lg px-3 py-2 hover:bg-white/10 text-slate-300">Voir le site public ↗</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}" class="px-3 py-4 border-t border-white/10">
      @csrf
      <button class="w-full text-left rounded-lg px-3 py-2 hover:bg-white/10 text-sm text-slate-300">Se déconnecter</button>
    </form>
  </aside>

  <div class="flex-1 flex flex-col min-w-0">
    <header class="md:hidden bg-slate-900 text-white px-4 py-3 flex items-center justify-between">
      <p class="font-bold">Miriam. — Admin</p>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="text-sm text-slate-300">Déconnexion</button>
      </form>
    </header>

    <main class="flex-1 px-5 md:px-10 py-8 max-w-4xl w-full">
      <h1 class="text-2xl font-bold mb-6">{{ $title ?? 'Tableau de bord' }}</h1>

      @if(session('status'))
        <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm">
          {{ session('status') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
          <ul class="list-disc pl-4 space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{ $slot }}
    </main>
  </div>
</div>
</body>
</html>
