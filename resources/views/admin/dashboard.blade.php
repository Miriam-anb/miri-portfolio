<x-admin-layout title="Tableau de bord">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
      <p class="text-sm text-slate-500">Messages</p>
      <p class="text-3xl font-bold mt-1">{{ $messagesCount }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
      <p class="text-sm text-slate-500">Non lus</p>
      <p class="text-3xl font-bold mt-1 text-indigo-600">{{ $unreadCount }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
      <p class="text-sm text-slate-500">Projets</p>
      <p class="text-3xl font-bold mt-1">{{ $projectsCount }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
      <p class="text-sm text-slate-500">Services</p>
      <p class="text-3xl font-bold mt-1">{{ $servicesCount }}</p>
    </div>
  </div>

  <div class="bg-white rounded-xl border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-semibold">Derniers messages</h2>
      <a href="{{ route('admin.messages.index') }}" class="text-sm text-indigo-600 hover:underline">Voir tout →</a>
    </div>
    @forelse($recentMessages as $m)
      <a href="{{ route('admin.messages.show', $m) }}" class="flex items-center justify-between py-3 border-b border-slate-100 last:border-0 hover:bg-slate-50 -mx-2 px-2 rounded">
        <div>
          <p class="font-medium text-sm">{{ $m->name }} @if(!$m->isRead())<span class="ml-2 inline-block w-2 h-2 rounded-full bg-indigo-600"></span>@endif</p>
          <p class="text-xs text-slate-500">{{ $m->email }}</p>
        </div>
        <p class="text-xs text-slate-400">{{ $m->created_at->diffForHumans() }}</p>
      </a>
    @empty
      <p class="text-sm text-slate-500">Aucun message pour le moment.</p>
    @endforelse
  </div>
</x-admin-layout>
