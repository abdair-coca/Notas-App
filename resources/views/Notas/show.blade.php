@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6">

    <div class="mb-6 flex items-center justify-between flex-wrap gap-3">
        <a href="{{ route('notas.index') }}" class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo inline-flex items-center gap-1">
            ← Volver a notas
        </a>
        <a href="{{ route('notas.edit', $nota) }}"
            class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
            ✏️ Editar notas
        </a>
    </div>

    <div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">
        <div class="p-7">
            <h1 class="font-fredoka text-3xl text-brand-dark mb-3">
                {{ $nota->titulo }}
            </h1>
            <div class="flex items-center gap-4">
                <p class="font-nunito text-sm text-brand-dark/80 mb-5">
                    {{ $nota->categoria }}
                </p>
                <form action="{{ route('notas.toggleFijada', $nota) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button
                        type="submit"
                        class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-yellow text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                        {{ $nota->fijada ? '📍 Desfijar' : '📌 Fijar' }}
                    </button>
                </form>
            </div>

            <div class="prose mt-2 prose-sm sm:prose-base max-w-none">
                {!! nl2br(e($nota->contenido)) !!}
            </div>
        </div>
    </div>
    <form id="delete-nota-form"
        action="{{ route('notas.destroy', $nota) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    <button type="button"
        class="font-fredoka m-2.5 text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-red-400 text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo"
        onclick="openModal('delete-nota-form', 'delete-nota-modal')">
        X Eliminar nota
    </button>

    <x-confirm-modal
        id="delete-nota-modal"
        title="Eliminar nota"
        message="Esta acción no se puede deshacer.">

        <button type="button"
            onclick="confirmAction('delete-nota-modal')"
            class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark bg-brand-pink text-white shadow-neo-btn transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
            🗑️ Confirmar
        </button>

    </x-confirm-modal>
</div>

@endsection