<x-admin-layout title="Message de {{ $message->name }}">
  <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
    <div class="grid sm:grid-cols-2 gap-4 text-sm">
      <div><p class="text-slate-500">Nom</p><p class="font-medium">{{ $message->name }}</p></div>
      <div><p class="text-slate-500">E-mail</p><p class="font-medium">{{ $message->email }}</p></div>
      @if($message->subject)
        <div class="sm:col-span-2"><p class="text-slate-500">Sujet</p><p class="font-medium">{{ $message->subject }}</p></div>
      @endif
      <div><p class="text-slate-500">Reçu le</p><p class="font-medium">{{ $message->created_at->format('d/m/Y à H:i') }}</p></div>
    </div>
    <div class="pt-4 border-t border-slate-100">
      <p class="text-slate-500 text-sm mb-2">Message</p>
      <p class="whitespace-pre-line">{{ $message->message }}</p>
    </div>
    <div class="flex gap-3 pt-4">
      <a href="mailto:{{ $message->email }}" class="rounded-lg bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 hover:bg-indigo-700">Répondre par e-mail</a>
      <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?');">
        @csrf @method('DELETE')
        <button class="rounded-lg border border-red-200 text-red-600 text-sm font-semibold px-5 py-2.5 hover:bg-red-50">Supprimer</button>
      </form>
      <a href="{{ route('admin.messages.index') }}" class="rounded-lg border border-slate-300 text-sm px-5 py-2.5 hover:bg-slate-50">← Retour</a>
    </div>
  </div>
</x-admin-layout>
