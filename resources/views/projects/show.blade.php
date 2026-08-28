<x-layout :settings="$settings">

  <section class="max-w-3xl mx-auto px-6 pt-16 pb-10">
    <a href="{{ route('home') }}#work" class="text-sm text-slate-500 hover:text-ink">← Retour aux projets</a>
    @if($project->featured)
      <span class="block w-fit mt-6 text-xs font-semibold text-accent bg-indigo-50 rounded-full px-3 py-1">Projet phare</span>
    @endif
    <h1 class="font-display font-extrabold text-3xl md:text-4xl mt-4 mb-4">{{ $project->title }}</h1>
    <p class="text-slate-600 text-lg leading-relaxed">{{ $project->summary }}</p>
    @if($project->tech_stack)
      <div class="flex flex-wrap gap-2 mt-6">
        @foreach(explode('·', $project->tech_stack) as $tech)
          <span class="text-xs font-medium text-slate-600 bg-slate-100 rounded-full px-3 py-1">{{ trim($tech) }}</span>
        @endforeach
      </div>
    @endif
  </section>

  @if($project->image)
    <section class="max-w-5xl mx-auto px-6 mb-14">
      <div class="aspect-video rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
      </div>
    </section>
  @endif

  @if($project->description)
    <section class="max-w-3xl mx-auto px-6 pb-14">
      <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
    </section>
  @endif

  @if($project->workflow_steps)
    <section class="bg-slate-50 border-y border-slate-100">
      <div class="max-w-3xl mx-auto px-6 py-14">
        <p class="text-xs font-semibold tracking-wide uppercase text-slate-500 mb-5">Le workflow, étape par étape</p>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 font-mono text-xs sm:text-sm">
          @foreach($project->workflow_steps as $i => $step)
            @if($i > 0)<span class="text-slate-300">→</span>@endif
            <span class="rounded-lg bg-white border border-slate-200 px-3 sm:px-4 py-2 font-semibold text-slate-700">{{ strtoupper($step) }}</span>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @if($otherProjects->count())
    <section class="max-w-5xl mx-auto px-6 py-16">
      <p class="text-xs font-semibold tracking-wide uppercase text-accent mb-6 text-center">Autres projets</p>
      <div class="grid sm:grid-cols-2 gap-6">
        @foreach($otherProjects as $p)
          <a href="{{ route('projects.show', $p) }}" class="block rounded-2xl border border-slate-200 p-6 hover:border-ink transition">
            <h3 class="font-display font-bold mb-2">{{ $p->title }}</h3>
            <p class="text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($p->summary, 100) }}</p>
          </a>
        @endforeach
      </div>
    </section>
  @endif

  <section class="max-w-3xl mx-auto px-6 pb-24 text-center">
    <h2 class="font-display font-bold text-2xl mb-4">Un projet similaire en tête ?</h2>
    <a href="{{ route('home') }}#contact" class="inline-block rounded-full bg-ink text-white font-semibold px-6 py-3 hover:bg-accent transition">Discutons-en</a>
  </section>

</x-layout>
