<x-admin-layout title="{{ $project->exists ? 'Modifier le projet' : 'Nouveau projet' }}">
  <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
    @csrf
    @if($project->exists) @method('PUT') @endif

    <div>
      <label class="block text-sm font-medium mb-1">Titre</label>
      <input name="title" value="{{ old('title', $project->title) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Slug (URL) — laisser vide pour générer automatiquement</label>
      <input name="slug" value="{{ old('slug', $project->slug) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Résumé court (affiché sur la liste)</label>
      <input name="summary" value="{{ old('summary', $project->summary) }}" required class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Description complète</label>
      <textarea name="description" rows="5" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('description', $project->description) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Stack technique (séparée par ·)</label>
      <input name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Étapes du workflow (une par ligne, optionnel)</label>
      <textarea name="workflow_steps_raw" rows="4" class="w-full rounded-lg border border-slate-300 px-3 py-2 font-mono text-sm">{{ old('workflow_steps_raw', $project->workflow_steps ? implode("\n", $project->workflow_steps) : '') }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Image</label>
      @if($project->image)
        <img src="{{ $project->image }}" class="w-32 h-20 object-cover rounded-lg mb-2 border border-slate-200">
      @endif
      <input type="file" name="image" accept="image/*" class="text-sm">
    </div>
    <div class="flex items-center gap-2">
      <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }} class="rounded border-slate-300">
      <label for="featured" class="text-sm font-medium">Mettre ce projet en avant</label>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Ordre d'affichage</label>
      <input type="number" name="position" value="{{ old('position', $project->position) }}" class="w-32 rounded-lg border border-slate-300 px-3 py-2">
    </div>

    <div class="flex gap-3 pt-2">
      <button type="submit" class="rounded-lg bg-indigo-600 text-white font-semibold px-6 py-2.5 hover:bg-indigo-700">Enregistrer</button>
      <a href="{{ route('admin.projects.index') }}" class="rounded-lg border border-slate-300 px-6 py-2.5 hover:bg-slate-50">Annuler</a>
    </div>
  </form>
</x-admin-layout>
