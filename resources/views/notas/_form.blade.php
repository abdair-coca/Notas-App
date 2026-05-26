{{-- Campo: Título --}}
<div class="space-y-2">
    <label class="block font-display font-bold text-[11px] uppercase tracking-[1px] text-[#1C1C1C]">
        🏷️ Título <span class="text-[#FF6B6B]">*</span>
    </label>
    <input type="text" name="titulo"
        value="{{ old('titulo', $nota->titulo ?? '') }}"
        placeholder="Mi próxima gran idea..."
        class="w-full font-nunito font-semibold text-sm @error('titulo') !border-[#FF6B6B] !bg-[#FFE4F0] @enderror">
    @error('titulo')
    <p class="text-[#FF6B6B] font-display font-extrabold text-xs flex items-center gap-1.5">
        ⚠️ {{ $message }}
    </p>
    @enderror
</div>

{{-- Campo: Contenido --}}
<div class="space-y-2">
    <label for="contenido" class="block font-display font-bold text-[11px] uppercase tracking-[1px] text-[#1C1C1C]">
        📝 Contenido
    </label>
    <textarea name="contenido" id="contenido" rows="5"
        placeholder="Escribe aquí tus pensamientos, ideas o lo que quieras recordar..."
        class="w-full font-nunito font-medium text-sm leading-relaxed resize-y min-h-[120px] sm:min-h-[160px] md:rows-7 @error('contenido') !border-[#FF6B6B] !bg-[#FFE4F0] @enderror">{{ old('contenido', $nota->contenido ?? '') }}</textarea>
    @error('contenido')
    <p class="text-[#FF6B6B] font-display font-extrabold text-xs flex items-center gap-1.5">
        ⚠️ {{ $message }}
    </p>
    @enderror
</div>

{{-- Campo: Categoría --}}
<div class="space-y-3">
    <label class="block font-display font-bold text-[11px] uppercase tracking-[1px] text-[#1C1C1C]">
        🎨 Categoría
    </label>

    @php
    $categorias = [
        'Personal' => ['emoji' => '💖', 'bg' => '#FFE4F0'],
        'Trabajo'  => ['emoji' => '💼', 'bg' => '#E0F2FE'],
        'Estudio'  => ['emoji' => '📚', 'bg' => '#D1FAE5'],
        'Ideas'    => ['emoji' => '💡', 'bg' => '#FEF9C3'],
    ];
    $seleccionada = old('categoria', $nota->categoria ?? '');
    @endphp

    <div class="flex flex-wrap items-center gap-2 sm:gap-2.5">
        @foreach($categorias as $nombre => $meta)
        @php $activa = $seleccionada === $nombre; @endphp
        <label class="cursor-pointer select-none">
            <input type="radio" name="categoria" value="{{ $nombre }}"
                {{ $activa ? 'checked' : '' }}
                class="peer sr-only">
            <span
                class="inline-flex items-center gap-1 sm:gap-1.5 px-3 sm:px-4 py-1.5 font-display font-bold text-[11px] sm:text-xs border-[2.5px] border-[#1C1C1C] rounded-full transition-all hover:-translate-y-0.5 bg-white shadow-none peer-checked:shadow-[3px_3px_0_#1C1C1C] peer-checked:-translate-y-0.5 peer-checked:bg-[var(--cat-bg)]"
                style="--cat-bg: {{ $meta['bg'] }}; color: #1C1C1C;">
                <span class="text-sm leading-none">{{ $meta['emoji'] }}</span>
                {{ $nombre }}
            </span>
        </label>
        @endforeach
    </div>

    @error('categoria')
    <p class="text-[#FF6B6B] font-display font-extrabold text-xs flex items-center gap-1.5">
        ⚠️ {{ $message }}
    </p>
    @enderror
</div>
