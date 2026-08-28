<x-admin-layout title="Paramètres du site">
  <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <section class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
      <h2 class="font-semibold">Général</h2>
      <div>
        <label class="block text-sm font-medium mb-1">Nom affiché</label>
        <input name="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Localisation</label>
        <input name="location" value="{{ old('location', $settings['location']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
      </div>
    </section>

    <section class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
      <h2 class="font-semibold">Section d'accueil (Hero)</h2>
      <div>
        <label class="block text-sm font-medium mb-1">Titre principal</label>
        <input name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Titre — partie accentuée</label>
        <input name="hero_accent" value="{{ old('hero_accent', $settings['hero_accent']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Sous-titre</label>
        <textarea name="hero_subtitle" rows="3" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
      </div>
    </section>

    <section class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
      <h2 class="font-semibold">À propos</h2>
      <div>
        <label class="block text-sm font-medium mb-1">Texte de présentation</label>
        <textarea name="about_text" rows="5" class="w-full rounded-lg border border-slate-300 px-3 py-2">{{ old('about_text', $settings['about_text']) }}</textarea>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Photo</label>
        @if(!empty($settings['about_photo']))
          <img src="{{ $settings['about_photo'] }}" class="w-24 h-24 object-cover rounded-lg mb-2 border border-slate-200">
        @endif
        <input type="file" name="about_photo" accept="image/*" class="text-sm">
      </div>
    </section>

    <section class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
      <h2 class="font-semibold">Contact</h2>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">E-mail</label>
          <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Téléphone</label>
          <input name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">WhatsApp (format international, sans +)</label>
          <input name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">LinkedIn (URL)</label>
          <input name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">GitHub (URL)</label>
          <input name="github_url" value="{{ old('github_url', $settings['github_url']) }}" class="w-full rounded-lg border border-slate-300 px-3 py-2">
        </div>
      </div>
    </section>

    <button type="submit" class="rounded-lg bg-indigo-600 text-white font-semibold px-6 py-2.5 hover:bg-indigo-700 transition">
      Enregistrer les modifications
    </button>
  </form>
</x-admin-layout>
