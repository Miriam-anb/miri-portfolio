<x-admin-layout title="Projets">
  <div class="flex justify-end mb-4">
    <a href="{{ route('admin.projects.create') }}" class="rounded-lg bg-indigo-600 text-white text-sm font-semibold px-4 py-2 hover:bg-indigo-700">+ Ajouter un projet</a>
  </div>
  <div class="bg-white rounded-xl border border-slate-200 divide-y divide-slate-100">
    @forelse($projects as $p)
      <div class="flex items-center justify-between p-5">
        <div>
          <p class="font-semibold">{{ $p->title }} @if($p->featured)<span class="ml-2 text-xs rounded-full bg-indigo-100 text-indigo-700 px-2 py-0.5">Mis en avant</span>@endif</p>
          <p class="text-sm text-slate-500 mt-1">{{ $p->summary }}</p>
        </div>
        <div class="flex items-center gap-3 flex-shrink-0 ml-4">
          <a href="{{ route('projects.show', $p) }}" target="_blank" class="text-sm text-slate-500 hover:underline">Voir</a>
          <a href="{{ route('admin.projects.edit', $p) }}" class="text-sm text-indigo-600 hover:underline">Modifier</a>
          <form method="POST" action="{{ route('admin.projects.destroy', $p) }}" onsubmit="return confirm('Supprimer ce projet ?');">
            @csrf @method('DELETE')
            <button class="text-sm text-red-600 hover:underline">Supprimer</button>
          </form>
        </div>
      </div>
    @empty
      <p class="p-5 text-sm text-slate-500">Aucun projet pour le moment.</p>
    @endforelse
  </div>
</x-admin-layout>
