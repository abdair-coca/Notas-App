<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        🏷️ Título <span class="text-brand-pink">*</span>
    </label>
    <input type="text" name="titulo"
        value="{{ old('titulo', $nota->titulo ?? '') }}"
        class="w-full border-[2.5px] @error('titulo') border-brand-pink bg-pink-50 @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    @error('titulo')
    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
{{-- Campo: Contenido --}}
<div>
    <label for="contenido" class="block font-fredoka text-sm text-brand-purple mb-1.5">📝 Contenido</label>
    <textarea name="contenido" id="contenido" rows="4"
        class="w-full border-[2.5px] border-brand-dark rounded-2xl px-4 py-3 font-nunito font-semibold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all resize-none">{{ old('contenido', $nota->contenido ?? '') }}</textarea>
</div>
{{-- Campo categoria --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🎨 Categoria</label>
    <div class="flex items-center gap-3">
        @php
        $categorias = ['Personal', 'Trabajo', 'Estudio', 'Ideas'];
        @endphp

        @foreach($categorias as $categoria)
        <label class="flex items-center gap-2">
            <input type="radio" name="categoria" value="{{ $categoria }}"
                {{ old('categoria', $nota->categoria ?? '') === $categoria ? 'checked' : '' }}
                class="form-radio text-brand-blue focus:ring-0 focus:ring-offset-0 focus:outline-none">
            <span class="font-nunito text-sm text-brand-dark">{{ $categoria }}</span>
        </label>
        @endforeach
    </div>
    @error('categoria')
    <p class="mt-1.5 text-xs font-extrabold text-brand-pink flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
