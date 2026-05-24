@extends('layouts.app')

@section('title', 'Catálogo de Notas')

@section('content')

{{-- ===== Welcome banner ===== --}}
<section
    class="bg-brand-blue border-[3px] border-brand-dark rounded-[20px] p-7 mb-7 flex items-center justify-between shadow-neo relative overflow-hidden">
    <div class="absolute -right-5 -bottom-5 w-32 h-32 bg-white/15 rounded-full pointer-events-none"></div>
    <div class="absolute right-20 top-4 w-12 h-12 bg-white/10 rounded-full pointer-events-none"></div>

    <div class="relative">
        <h1 class="font-fredoka text-3xl md:text-4xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">
            ¡Hola, Maravilloso Lector! 👋
        </h1>
        <p class="text-white/90 font-bold text-sm md:text-base mt-2">
            Explora nuestro catálogo y encuentra tu próxima aventura.
        </p>
    </div>
    <span class="text-6xl md:text-7xl relative">🦉</span>
</section>

{{-- ===== Header del catálogo ===== --}}
<header class="flex flex-wrap items-end justify-between gap-3 mb-6">
    <div>
        <h2 class="font-fredoka text-2xl md:text-3xl text-brand-dark flex items-center gap-2">
            📚 Catálogo de Notas
        </h2>
        <p class="font-extrabold text-xs text-brand-dark/60 mt-1 uppercase tracking-wider">
            Todas las notas disponibles
        </p>
    </div>

</header>

{{-- ===== Grid de notas ===== --}}
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($notas as $nota)
    <x-nota-card :nota="$nota" />
    @endforeach
</section>

@endsection
