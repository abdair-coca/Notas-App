@extends('layouts.app')

@section('title', 'Catálogo de Notas')

@section('content')

{{-- ===== Tab bar (scroll horizontal en móvil) ===== --}}
<nav class="border-b-2 border-[#1C1C1C] mb-6 md:mb-8 -mx-4 md:-mx-6">
    <div class="flex items-center md:justify-center gap-4 sm:gap-6 md:gap-8 px-4 md:px-6 overflow-x-auto whitespace-nowrap [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        <a href="{{ route('notas.index') }}"
            id="tab-todas"
            class="font-display font-bold text-[13px] text-[#888] py-3 border-b-[3px] border-transparent hover:text-[#3B82F6] transition-colors shrink-0">
            Todas
        </a>
        <a href="{{ route('notas.categoria', 'Personal') }}"
            id="tab-personal"
            class="font-display font-bold text-[13px] text-[#888] py-3 border-b-[3px] border-transparent hover:text-[#3B82F6] transition-colors shrink-0">
            Personal
        </a>
        <a href="{{ route('notas.categoria', 'Trabajo') }}"
            id="tab-trabajo"
            class="font-display font-bold text-[13px] text-[#888] py-3 border-b-[3px] border-transparent hover:text-[#3B82F6] transition-colors shrink-0">
            Trabajo
        </a>
        <a href="{{ route('notas.categoria', 'Estudio') }}"
            id="tab-estudio"
            class="font-display font-bold text-[13px] text-[#888] py-3 border-b-[3px] border-transparent hover:text-[#3B82F6] transition-colors shrink-0">
            Estudio
        </a>
        <a href="{{ route('notas.categoria', 'Ideas') }}"
            id="tab-ideas"
            class="font-display font-bold text-[13px] text-[#888] py-3 border-b-[3px] border-transparent hover:text-[#3B82F6] transition-colors shrink-0">
            Ideas
        </a>
    </div>
</nav>

{{-- ===== Page header (título + subtítulo + búsqueda) ===== --}}
<header class="flex flex-col items-center text-center gap-2.5 md:gap-3 mb-6 md:mb-8 px-2">
    <h1 class="font-display font-extrabold text-2xl sm:text-3xl md:text-[32px] text-[#1C1C1C]">
        Tus Notas
    </h1>
    <p class="font-nunito font-semibold text-xs sm:text-sm text-[#888] max-w-xs sm:max-w-none">
        Aquí están todas tus ideas organizadas. ¡Haz algo increíble!
    </p>

    <form
        action="{{ route('notas.index') }}"
        method="GET"
        class="flex items-center gap-2 bg-white border-[2.5px] border-[#1C1C1C] rounded-full px-4 py-1.5 shadow-[4px_4px_0px_#1C1C1C] w-full max-w-[260px] mt-1 transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-[6px_6px_0px_#1C1C1C]">

        <button
            type="submit"
            class="text-base hover:scale-110 transition-transform shrink-0">
            🔍
        </button>

        <input
            id="search-input"
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar notas..."
            class="flex-1 min-w-0 font-nunito text-sm font-medium text-[#1C1C1C] placeholder:text-[#888]"
            style="background:transparent !important; border:0 !important; padding:0 !important; border-radius:0 !important; box-shadow:none !important; outline:none !important; height:auto !important;">

        @if(request('search'))
        <a
            href="{{ route('notas.index') }}"
            class="shrink-0 text-[10px] font-display font-extrabold bg-[#FFE4F0] w-5 h-5 inline-flex items-center justify-center rounded-full border-2 border-[#1C1C1C] hover:scale-110 transition">
            ✕
        </a>
        @endif
    </form>
</header>

{{-- ===== Grid de notas / Estado vacío ===== --}}
@if($notas->isEmpty())
<div class="mt-6 flex flex-col items-center justify-center bg-white border-[2.5px] border-[#1C1C1C] rounded-[20px] p-6 sm:p-8 md:p-10 shadow-brutal max-w-md mx-auto text-center">
    <div class="text-5xl sm:text-6xl animate-bounce">😿</div>
    <h2 class="mt-4 font-display font-extrabold text-xl sm:text-2xl text-[#1C1C1C]">
        No se encontraron notas
    </h2>
    <p class="mt-2 font-nunito font-semibold text-xs sm:text-sm text-[#888]">
        @if(request('search'))
            No hay coincidencias para "<span class="font-bold text-[#1C1C1C] break-words">{{ request('search') }}</span>". Intenta con otro término.
        @else
            Aún no tienes notas. ¡Crea la primera!
        @endif
    </p>
    @if(request('search'))
    <a href="{{ route('notas.index') }}"
        class="mt-5 font-display font-extrabold text-sm px-5 py-2 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FFD166] text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-1.5">
        ✕ Limpiar búsqueda
    </a>
    @else
    <a href="{{ route('notas.create') }}"
        class="mt-5 font-display font-extrabold text-sm px-5 py-2 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FFD166] text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-1.5">
        ➕ Crear nota
    </a>
    @endif
</div>
@else
<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
    @foreach($notas as $nota)
    <x-nota-card :nota="$nota" />
    @endforeach
</section>
@endif

@endsection