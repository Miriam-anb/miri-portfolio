<x-admin-layout title="Services">
  <div class="flex justify-end mb-4">
    <a href="{{ route('admin.services.create') }}" class="rounded-lg bg-indigo-600 text-white text-sm font-semibold px-4 py-2 hover:bg-indigo-700">+ Ajouter un service</a>
  </div>
  <div class="bg-white rounded-xl border border-slate-200 divide-y divide-slate-100">
    @forelse($services as $s)
      <div class="flex items-center justify-between p-5">
        <div>
          <p class="font-semibold">{{ $s->title }}</p>
          <p class="text-sm text-slate-500 mt-1">{{ \Illuminate\Support\Str::limit($s->description, 100) }}</p>
        </div>
        <div class="flex items-center gap-3 flex-shrink-0 ml-4">
          <a href="{{ route('admin.services.edit', $s) }}" class="text-sm text-indigo-600 hover:underline">Modifier</a>
          <form method="POST" action="{{ route('admin.services.destroy', $s) }}" onsubmit="return confirm('Supprimer ce service ?');">
            @csrf @method('DELETE')
            <button class="text-sm text-red-600 hover:underline">Supprimer</button>
          </form>
        </div>
      </div>
    @empty
      <p class="p-5 text-sm text-slate-500">Aucun service pour le moment.</p>
    @endforelse
  </div>
</x-admin-layout>
