<x-admin-layout title="{{ $service->exists ? 'Modifier le service' : 'Nouveau service' }}">
  <form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div>
      <label class="block text-sm font-medium mb-1">Titre</label>
      <input name="title" value="{{ old('title', $service->title) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Description</label>
      <textarea name="description" rows="4" required class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description', $service->description) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Ordre d'affichage</label>
      <input type="number" name="position" value="{{ old('position', $service->position) }}" class="w-32 rounded-lg border border-slate-300 px-3 py-2">
    </div>

    <div class="flex gap-3 pt-2">
      <button type="submit" class="rounded-lg bg-indigo-600 text-white font-semibold px-6 py-2.5 hover:bg-indigo-700">Enregistrer</button>
      <a href="{{ route('admin.services.index') }}" class="rounded-lg border border-slate-300 px-6 py-2.5 hover:bg-slate-50">Annuler</a>
    </div>
  </form>
</x-admin-layout>
