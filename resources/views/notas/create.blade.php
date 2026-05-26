@extends('layouts.app')
@section('title', 'Registrar nota')
@section('content')

<div class="max-w-3xl mx-auto">

    {{-- ===== Header ===== --}}
    <header class="flex flex-col items-center text-center gap-2 mb-6 md:mb-8 px-2">
        <span class="text-4xl sm:text-5xl">📝</span>
        <h1 class="font-display font-extrabold text-2xl sm:text-3xl md:text-[32px] text-[#1C1C1C]">
            Crear Nueva Nota
        </h1>
        <p class="font-nunito font-semibold text-xs sm:text-sm text-[#888] max-w-xs sm:max-w-none">
            Captura una idea fresca antes de que se escape ✨
        </p>
    </header>

    {{-- ===== Errores globales ===== --}}
    @if ($errors->any())
    <div class="mb-6 bg-[#FFE4F0] border-[2.5px] border-[#1C1C1C] rounded-[14px] px-4 sm:px-5 py-3 sm:py-4 shadow-brutal-sm">
        <p class="font-display font-extrabold text-xs sm:text-sm text-[#1C1C1C] mb-2 flex items-center gap-2">
            ⚠️ Por favor corrige los siguientes errores:
        </p>
        <ul class="list-disc list-inside text-[#1C1C1C] font-nunito font-bold text-xs sm:text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ===== Formulario ===== --}}
    <form action="{{ route('notas.store') }}" method="POST"
        class="bg-white border-[2.5px] border-[#1C1C1C] rounded-[20px] shadow-brutal p-5 sm:p-6 md:p-8 space-y-5 md:space-y-6 relative">

        {{-- Barra de acento superior (regla design.md §5.3) --}}
        <div class="absolute top-0 left-5 right-5 sm:left-6 sm:right-6 h-1.5 rounded-full bg-[#FFD166] opacity-60 -translate-y-1/2"></div>

        @csrf
        @include('notas._form', ['nota' => null])

        {{-- Acciones --}}
        <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 pt-5 border-t-2 border-dashed border-[#1C1C1C]/15">
            <button type="submit"
                class="w-full sm:w-auto justify-center font-display font-extrabold text-sm md:text-base px-7 py-2.5 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FFD166] text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-2">
                💾 Guardar nota
            </button>
            <a href="{{ route('notas.index') }}"
                class="w-full sm:w-auto justify-center font-display font-extrabold text-sm md:text-base px-7 py-2.5 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-white text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-2">
                ✖️ Cancelar
            </a>
        </div>
    </form>

    {{-- Tip card --}}
    <div class="mt-6 bg-[#E0F2FE] border-[2.5px] border-[#1C1C1C] rounded-2xl px-4 sm:px-5 py-3 shadow-brutal-sm flex items-start sm:items-center gap-3">
        <span class="text-xl sm:text-2xl shrink-0">💡</span>
        <p class="font-nunito font-bold text-xs sm:text-sm text-[#1C1C1C] leading-snug">
            <span class="font-display font-extrabold uppercase tracking-wider text-[10px] sm:text-[11px] text-[#3B82F6]">Tip:</span>
            Un buen título resume tu idea en menos de 6 palabras.
        </p>
    </div>

</div>

@endsection
