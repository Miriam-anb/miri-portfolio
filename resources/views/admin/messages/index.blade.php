<x-admin-layout title="Messages">
  <div class="bg-white rounded-xl border border-slate-200 divide-y divide-slate-100">
    @forelse($messages as $m)
      <a href="{{ route('admin.messages.show', $m) }}" class="flex items-center justify-between p-5 hover:bg-slate-50">
        <div>
          <p class="font-semibold text-sm">
            {{ $m->name }}
            @if(!$m->isRead())<span class="ml-2 inline-block w-2 h-2 rounded-full bg-indigo-600" title="Non lu"></span>@endif
          </p>
          <p class="text-xs text-slate-500">{{ $m->email }} @if($m->subject) — {{ $m->subject }} @endif</p>
          <p class="text-sm text-slate-600 mt-1">{{ \Illuminate\Support\Str::limit($m->message, 90) }}</p>
        </div>
        <p class="text-xs text-slate-400 flex-shrink-0 ml-4">{{ $m->created_at->diffForHumans() }}</p>
      </a>
    @empty
      <p class="p-5 text-sm text-slate-500">Aucun message reçu pour le moment.</p>
    @endforelse
  </div>
</x-admin-layout>
