<x-layout :settings="$settings">

  <!-- HERO -->
  <section class="max-w-6xl mx-auto px-6 pt-16 md:pt-24 pb-16 text-center">
    <p class="reveal in inline-flex items-center gap-2 text-xs font-semibold tracking-wide uppercase text-accent bg-indigo-50 rounded-full px-4 py-1.5 mb-6">
      Développeuse Agents IA &amp; Automatisation
    </p>
    <h1 class="reveal in font-display font-extrabold text-4xl sm:text-5xl md:text-6xl leading-[1.08] tracking-tight max-w-3xl mx-auto">
      {{ $settings['hero_title'] }} <span class="text-accent">{{ $settings['hero_accent'] }}</span>
    </h1>
    <p class="reveal in text-slate-600 text-lg max-w-2xl mx-auto mt-6">
      {{ $settings['hero_subtitle'] }}
    </p>
    <div class="reveal in flex flex-wrap items-center justify-center gap-4 mt-8">
      <a href="#contact" class="rounded-full bg-ink text-white font-semibold px-6 py-3 hover:bg-accent transition">Discutons de votre projet</a>
      <a href="#work" class="rounded-full border border-slate-300 font-semibold px-6 py-3 hover:border-ink transition">Voir mes projets</a>
    </div>

    <!-- flow diagram -->
    <div class="reveal in mt-16 flex flex-wrap items-center justify-center gap-2 sm:gap-3 font-mono text-xs sm:text-sm">
      @foreach(['INPUT','AI AGENT','AUTOMATION','RESULT'] as $i => $step)
        @if($i > 0)<span class="text-slate-300">→</span>@endif
        <span class="rounded-lg border border-slate-200 bg-slate-50 px-3 sm:px-4 py-2 font-semibold text-slate-700">{{ $step }}</span>
      @endforeach
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="max-w-6xl mx-auto px-6 py-16 md:py-24">
    <div class="grid md:grid-cols-[280px_1fr] gap-10 md:gap-16 items-start">
      <div class="reveal">
        <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
          @if(!empty($settings['about_photo']))
            <img src="{{ $settings['about_photo'] }}" alt="Miriam Anibaba" class="w-full h-full object-cover">
          @else
            <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">Photo</div>
          @endif
        </div>
        @if(!empty($settings['location']))
          <p class="text-sm text-slate-500 mt-3">📍 {{ $settings['location'] }}</p>
        @endif
      </div>
      <div class="reveal">
        <p class="text-xs font-semibold tracking-wide uppercase text-accent mb-3">À propos</p>
        <h2 class="font-display font-bold text-2xl md:text-3xl mb-5">Miriam Anibaba</h2>
        <p class="text-slate-600 leading-relaxed text-lg">{{ $settings['about_text'] }}</p>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section id="services" class="bg-slate-50 border-y border-slate-100">
    <div class="max-w-6xl mx-auto px-6 py-16 md:py-24">
      <p class="reveal text-xs font-semibold tracking-wide uppercase text-accent mb-3 text-center">Services</p>
      <h2 class="reveal font-display font-bold text-2xl md:text-3xl text-center mb-12">Comment je peux vous aider</h2>
      <div class="grid md:grid-cols-3 gap-6">
        @foreach($services as $i => $s)
          <div class="reveal bg-white rounded-2xl border border-slate-200 p-6">
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-50 text-accent font-bold text-sm mb-4">{{ $i + 1 }}</span>
            <h3 class="font-display font-bold text-lg mb-2">{{ $s->title }}</h3>
            <p class="text-slate-600 text-sm leading-relaxed">{{ $s->description }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- WORK -->
  <section id="work" class="max-w-6xl mx-auto px-6 py-16 md:py-24">
    <p class="reveal text-xs font-semibold tracking-wide uppercase text-accent mb-3 text-center">Projets</p>
    <h2 class="reveal font-display font-bold text-2xl md:text-3xl text-center mb-12">Réalisations récentes</h2>

    <div class="space-y-16">
      @foreach($projects as $p)
        <div class="reveal grid md:grid-cols-2 gap-8 md:gap-12 items-center {{ $loop->odd ? '' : 'md:[&>*:first-child]:order-2' }}">
          <div class="aspect-video rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
            @if($p->image)
              <img src="{{ $p->image }}" alt="{{ $p->title }}" class="w-full h-full object-cover">
            @else
              <span class="text-slate-400 text-sm px-6 text-center">{{ $p->title }}</span>
            @endif
          </div>
          <div>
            @if($p->featured)
              <span class="inline-block text-xs font-semibold text-accent bg-indigo-50 rounded-full px-3 py-1 mb-3">Projet phare</span>
            @endif
            <h3 class="font-display font-bold text-xl md:text-2xl mb-3">{{ $p->title }}</h3>
            <p class="text-slate-600 leading-relaxed mb-4">{{ $p->summary }}</p>
            @if($p->tech_stack)
              <div class="flex flex-wrap gap-2 mb-5">
                @foreach(explode('·', $p->tech_stack) as $tech)
                  <span class="text-xs font-medium text-slate-600 bg-slate-100 rounded-full px-3 py-1">{{ trim($tech) }}</span>
                @endforeach
              </div>
            @endif
            <a href="{{ route('projects.show', $p) }}" class="text-sm font-semibold text-accent hover:underline">Voir le projet en détail →</a>
          </div>
        </div>

        @if($p->featured && $p->workflow_steps)
          <div class="reveal rounded-2xl border border-slate-200 bg-slate-50 p-6 md:p-8">
            <p class="text-xs font-semibold tracking-wide uppercase text-slate-500 mb-4">Le workflow, étape par étape</p>
            <div class="flex flex-wrap items-center gap-2 sm:gap-3 font-mono text-xs sm:text-sm">
              @foreach($p->workflow_steps as $i => $step)
                @if($i > 0)<span class="text-slate-300">→</span>@endif
                <span class="rounded-lg bg-white border border-slate-200 px-3 sm:px-4 py-2 font-semibold text-slate-700">{{ strtoupper($step) }}</span>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </section>

  <!-- WHY WORK WITH ME (replaces testimonials) -->
  <section id="why" class="bg-ink text-white">
    <div class="max-w-6xl mx-auto px-6 py-16 md:py-24">
      <p class="reveal text-xs font-semibold tracking-wide uppercase text-indigo-300 mb-3 text-center">Pourquoi travailler avec moi</p>
      <h2 class="reveal font-display font-bold text-2xl md:text-3xl text-center mb-12">Une approche rigoureuse, orientée résultats</h2>
      <div class="grid sm:grid-cols-3 gap-8">
        <div class="reveal">
          <h3 class="font-display font-bold text-lg mb-2">Autonomie &amp; fiabilité</h3>
          <p class="text-slate-300 text-sm leading-relaxed">Je conçois des solutions robustes, testées et documentées — de la première ligne de code à la mise en production.</p>
        </div>
        <div class="reveal">
          <h3 class="font-display font-bold text-lg mb-2">Vision bout-en-bout</h3>
          <p class="text-slate-300 text-sm leading-relaxed">Développement, tests et automatisation : je couvre l'ensemble de la chaîne pour livrer des solutions qui fonctionnent réellement.</p>
        </div>
        <div class="reveal">
          <h3 class="font-display font-bold text-lg mb-2">Communication claire</h3>
          <p class="text-slate-300 text-sm leading-relaxed">Un point de contact unique, des délais respectés et un suivi transparent tout au long du projet.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="max-w-3xl mx-auto px-6 py-16 md:py-24">
    <p class="reveal text-xs font-semibold tracking-wide uppercase text-accent mb-3 text-center">Contact</p>
    <h2 class="reveal font-display font-bold text-2xl md:text-3xl text-center mb-4">Parlons de votre projet</h2>
    <p class="reveal text-slate-600 text-center mb-10">
      {{ $settings['contact_email'] }}
      @if(!empty($settings['contact_whatsapp'])) · <a href="https://wa.me/{{ $settings['contact_whatsapp'] }}" target="_blank" class="text-accent hover:underline">WhatsApp</a>@endif
    </p>

    @if(session('status'))
      <div class="reveal mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm text-center">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" class="reveal space-y-4">
      @csrf
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <input name="name" value="{{ old('name') }}" placeholder="Votre nom" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent">
          @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="Votre e-mail" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent">
          @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
      <input name="subject" value="{{ old('subject') }}" placeholder="Sujet (optionnel)" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent">
      <textarea name="message" rows="5" placeholder="Votre message" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent">{{ old('message') }}</textarea>
      @error('message')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
      <button type="submit" class="w-full rounded-lg bg-ink text-white font-semibold py-3.5 hover:bg-accent transition">Envoyer le message</button>
    </form>
  </section>

</x-layout>
