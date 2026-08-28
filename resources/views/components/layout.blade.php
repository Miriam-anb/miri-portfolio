<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $settings['site_name'] ?? 'Miriam Anibaba' }} — Développeuse Agents IA & Automatisation</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          display: ['"Plus Jakarta Sans"', 'sans-serif'],
          mono: ['"IBM Plex Mono"', 'monospace'],
        },
        colors: {
          ink: '#0f172a',
          accent: '#4f46e5',
        }
      }
    }
  }
</script>
<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }
  .reveal { opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; }
  .reveal.in { opacity: 1; transform: none; }
</style>
</head>
<body class="bg-white text-ink antialiased">

<header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-100">
  <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-display font-bold text-lg">Miriam<span class="text-accent">.</span></a>
    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
      <a href="#about" class="hover:text-ink">À propos</a>
      <a href="#services" class="hover:text-ink">Services</a>
      <a href="#work" class="hover:text-ink">Projets</a>
      <a href="#why" class="hover:text-ink">Pourquoi moi</a>
      <a href="#contact" class="hover:text-ink">Contact</a>
    </nav>
    <a href="#contact" class="inline-flex items-center rounded-full bg-ink text-white text-sm font-semibold px-5 py-2.5 hover:bg-accent transition">Me contacter</a>
  </div>
</header>

<main>
  {{ $slot }}
</main>

<footer class="border-t border-slate-100 py-10 mt-10">
  <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500">
    <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Miriam Anibaba' }}. Tous droits réservés.</p>
    <div class="flex items-center gap-5">
      @if(!empty($settings['linkedin_url']) && $settings['linkedin_url'] !== '#')
        <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="hover:text-ink">LinkedIn</a>
      @endif
      @if(!empty($settings['github_url']) && $settings['github_url'] !== '#')
        <a href="{{ $settings['github_url'] }}" target="_blank" class="hover:text-ink">GitHub</a>
      @endif
      <a href="{{ route('admin.login') }}" class="hover:text-ink">Admin</a>
    </div>
  </div>
</footer>

<script>
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));
</script>
</body>
</html>
