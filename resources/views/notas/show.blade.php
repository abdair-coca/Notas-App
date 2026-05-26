@extends('layouts.app')
@section('title', $nota->titulo)
@section('content')

@php
    // Mapeo categoría → color suave + barra de acento (design.md §2.3)
    $categoriaColores = [
        'Personal' => ['bg' => '#FFE4F0', 'accent' => '#FF6B6B', 'emoji' => '💖'],
        'Trabajo'  => ['bg' => '#E0F2FE', 'accent' => '#3B82F6', 'emoji' => '💼'],
        'Estudio'  => ['bg' => '#D1FAE5', 'accent' => '#10B981', 'emoji' => '📚'],
        'Ideas'    => ['bg' => '#FEF9C3', 'accent' => '#F59E0B', 'emoji' => '💡'],
    ];
    $cat = $categoriaColores[$nota->categoria] ?? ['bg' => '#EDE9FE', 'accent' => '#8B5CF6', 'emoji' => '🗒️'];
@endphp

<div class="max-w-6xl mx-auto">

    {{-- ===== Top bar ===== --}}
    <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
        <a href="{{ route('notas.index') }}"
            class="font-display font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-[#1C1C1C] bg-white shadow-brutal-sm text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-1.5">
            ← Volver a notas
        </a>

        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('notas.edit', $nota) }}"
                class="font-display font-extrabold text-sm px-5 py-1.5 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FFD166] text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-1.5">
                ✏️ Editar
            </a>
            <button type="button"
                onclick="openModal('delete-nota-form', 'delete-nota-modal')"
                class="font-display font-extrabold text-sm px-5 py-1.5 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FF6B6B] text-white transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center gap-1.5">
                🗑️ Eliminar
            </button>
        </div>
    </div>

    {{-- ===== Layout: contenido + sidebar (design.md §6.3) ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_260px] gap-6 items-start">

        {{-- ===== Contenido principal ===== --}}
        <article class="bg-white border-[2.5px] border-[#1C1C1C] rounded-[20px] shadow-brutal overflow-hidden relative">
            {{-- Barra de color de acento (§5.3) --}}
            <div class="h-1.5 rounded-full mx-6 mt-5 opacity-60" style="background-color: {{ $cat['accent'] }};"></div>

            <div class="p-6 md:p-8">
                <div class="flex items-start gap-3 mb-4 flex-wrap">
                    <span class="text-3xl leading-none">{{ $cat['emoji'] }}</span>
                    <h1 class="font-display font-extrabold text-3xl md:text-4xl text-[#1C1C1C] break-words leading-tight flex-1 min-w-0">
                        {{ $nota->titulo }}
                    </h1>
                </div>

                <div class="flex items-center gap-2 flex-wrap mb-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 font-display font-bold text-[11px] uppercase tracking-wide border-2 border-[#1C1C1C] rounded-full"
                        style="background-color: {{ $cat['bg'] }};">
                        {{ $cat['emoji'] }} {{ $nota->categoria }}
                    </span>

                    @if($nota->fijada)
                    <span class="inline-flex items-center gap-1 px-3 py-0.5 font-display font-bold text-[11px] uppercase tracking-wide border-2 border-[#1C1C1C] rounded-full bg-[#FEF9C3]">
                        📌 Fijada
                    </span>
                    @endif
                </div>

                <div class="font-nunito text-[15px] leading-[1.7] text-[#333] whitespace-pre-line break-words">
                    {!! nl2br(e($nota->contenido)) !!}
                </div>
            </div>
        </article>

        {{-- ===== Sidebar (design.md §5.12) ===== --}}
        <aside class="space-y-4">

            {{-- Acciones rápidas --}}
            <div class="bg-white border-[2.5px] border-[#1C1C1C] rounded-2xl p-5 shadow-brutal-sm">
                <p class="font-display font-bold text-[11px] uppercase tracking-[1px] text-[#aaa] mb-3">
                    Acciones
                </p>
                <form action="{{ route('notas.toggleFijada', $nota) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="w-full font-display font-extrabold text-sm px-4 py-2 rounded-full border-[2.5px] border-[#1C1C1C] shadow-brutal-sm bg-[#FFD166] text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal inline-flex items-center justify-center gap-1.5">
                        {{ $nota->fijada ? '📍 Desfijar nota' : '📌 Fijar nota' }}
                    </button>
                </form>
            </div>

            {{-- Metadata --}}
            <div class="bg-white border-[2.5px] border-[#1C1C1C] rounded-2xl p-5 shadow-brutal-sm space-y-4">
                <p class="font-display font-bold text-[11px] uppercase tracking-[1px] text-[#aaa]">
                    Detalles
                </p>

                <div>
                    <p class="font-display font-bold text-[10px] uppercase tracking-wider text-[#888] mb-0.5">Categoría</p>
                    <p class="font-nunito font-bold text-sm text-[#1C1C1C]">{{ $nota->categoria }}</p>
                </div>

                <div>
                    <p class="font-display font-bold text-[10px] uppercase tracking-wider text-[#888] mb-0.5">Estado</p>
                    <p class="font-nunito font-bold text-sm text-[#1C1C1C]">
                        {{ $nota->fijada ? '📌 Fijada' : '🗒️ Normal' }}
                    </p>
                </div>

                @isset($nota->created_at)
                <div>
                    <p class="font-display font-bold text-[10px] uppercase tracking-wider text-[#888] mb-0.5">Creada</p>
                    <p class="font-nunito font-bold text-sm text-[#1C1C1C]">
                        {{ $nota->created_at->format('d M Y') }}
                    </p>
                </div>
                @endisset

                @isset($nota->updated_at)
                <div>
                    <p class="font-display font-bold text-[10px] uppercase tracking-wider text-[#888] mb-0.5">Actualizada</p>
                    <p class="font-nunito font-bold text-sm text-[#1C1C1C]">
                        {{ $nota->updated_at->format('d M Y') }}
                    </p>
                </div>
                @endisset
            </div>

            {{-- Tip card --}}
            <div class="bg-[#E0F2FE] border-[2.5px] border-[#1C1C1C] rounded-2xl p-4 shadow-brutal-sm flex items-start gap-2.5">
                <span class="text-xl leading-none">✨</span>
                <p class="font-nunito font-bold text-xs text-[#1C1C1C] leading-snug">
                    Las mejores ideas nacen cuando menos lo esperas. Vuelve aquí cuando quieras revisarla.
                </p>
            </div>
        </aside>
    </div>

    {{-- ===== Form de eliminación + modal ===== --}}
    <form id="delete-nota-form" action="{{ route('notas.destroy', $nota) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <x-confirm-modal
        id="delete-nota-modal"
        title="¿Eliminar esta nota?"
        message="Esta acción no se puede deshacer.">
        <button type="button"
            onclick="confirmAction('delete-nota-modal')"
            class="font-display font-extrabold text-sm px-5 py-2 rounded-full border-[2.5px] border-[#1C1C1C] bg-[#FF6B6B] text-white shadow-brutal-sm transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-brutal">
            🗑️ Sí, eliminar
        </button>
    </x-confirm-modal>

</div>

@endsection
