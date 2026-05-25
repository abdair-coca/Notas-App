@props(['nota'])

@php
  // Map categories to colors as per design.md
  $categoryColors = [
      'Personal' => ['bg' => 'bg-[#FFE4F0]', 'accent' => '#FF6B6B'],
      'Trabajo'  => ['bg' => 'bg-[#E0F2FE]', 'accent' => '#3B82F6'],
      'Estudio'  => ['bg' => 'bg-[#EDE9FE]', 'accent' => '#8B5CF6'],
      'Ideas'    => ['bg' => 'bg-[#FEF9C3]', 'accent' => '#F59E0B'],
  ];

  // Default color list if category doesn't match or for variety
  $colors = [
      ['bg' => 'bg-[#FFE4F0]', 'accent' => '#FF6B6B'],
      ['bg' => 'bg-[#E0F2FE]', 'accent' => '#3B82F6'],
      ['bg' => 'bg-[#D1FAE5]', 'accent' => '#10B981'],
      ['bg' => 'bg-[#FEF9C3]', 'accent' => '#F59E0B'],
      ['bg' => 'bg-[#EDE9FE]', 'accent' => '#8B5CF6'],
      ['bg' => 'bg-[#FFEDD5]', 'accent' => '#F97316'],
      ['bg' => 'bg-[#FCE7F3]', 'accent' => '#EC4899'],
      ['bg' => 'bg-[#ECFDF5]', 'accent' => '#34D399'],
  ];

  $category = $nota->categoria ?? '';
  if (isset($categoryColors[$category])) {
      $selectedColor = $categoryColors[$category];
  } else {
      $colorIndex = ($nota->id ?? 0) % count($colors);
      $selectedColor = $colors[$colorIndex];
  }

  $cardBg = $selectedColor['bg'];
  $accentColor = $selectedColor['accent'];

  // Alternating card rotation
  $rotations = ['rotate-0', 'rotate-[0.6deg]', '-rotate-[0.5deg]', 'rotate-[0.4deg]', '-rotate-[0.3deg]', 'rotate-[0.7deg]'];
  $rot = $rotations[($nota->id ?? 0) % count($rotations)];
@endphp

<div class="note-card {{ $cardBg }} {{ $rot }} group relative flex flex-col h-full min-h-[190px] justify-between z-10">
    <!-- Card internal pattern texture -->
    <div class="note-card-texture"></div>

    <!-- Pinned indicator background star -->
    @if($nota->fijada)
        <div class="absolute top-2.5 right-2.5 pointer-events-none text-sm text-[#1C1C1C] opacity-75 animate-star-float">✦</div>
    @endif

    <!-- Content clickable overlay -->
    <a href="{{ route('notas.show', $nota) }}" class="absolute inset-0 z-0" aria-label="Ver nota {{ $nota->titulo }}"></a>

    <!-- Top section (Title, Accent bar, and content body) -->
    <div class="relative z-10 pointer-events-none flex-1 flex flex-col">
        <!-- Accent color bar -->
        <div class="h-1.5 w-full rounded-full opacity-60 mb-2.5" style="background-color: {{ $accentColor }};"></div>

        <!-- Title -->
        <h3 class="font-display font-extrabold text-[15px] leading-tight text-[#1C1C1C] mb-2 group-hover:text-[#3B82F6] transition-colors duration-150">
            {{ $nota->titulo }}
        </h3>

        <!-- Body content (limit to 2 lines) -->
        <p class="font-body text-xs font-normal text-[#555] line-clamp-2 leading-relaxed flex-1">
            {{ Str::limit($nota->contenido, 80) }}
        </p>
    </div>

    <!-- Footer section with actions and badges -->
    <div class="relative z-10 mt-3 pt-2.5 border-t border-[#1C1C1C]/10 flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-1.5 flex-wrap">
            <!-- Date metadata -->
            <span class="font-body font-bold text-[9px] text-[#888] uppercase tracking-wider">
                {{ $nota->created_at ? $nota->created_at->format('d M') : '' }}
            </span>

            <!-- Badge category -->
            <span class="font-display font-bold text-[10px] px-2 py-0.5 rounded-full border-2 border-[#1C1C1C] bg-[#FFF8ED] text-[#1C1C1C]">
                {{ $nota->categoria }}
            </span>
        </div>

        <!-- Interactive action buttons -->
        <div class="flex items-center gap-1 pointer-events-auto">
            <!-- Pin button -->
            <form action="{{ route('notas.toggleFijada', $nota) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-7 h-7 flex items-center justify-center border-2 border-[#1C1C1C] rounded-full @if($nota->fijada) bg-[#FFD166] @else bg-white @endif text-xs hover:scale-115 hover:bg-[#FFD166] active:scale-97 transition-all cursor-pointer" title="{{ $nota->fijada ? 'Desfijar' : 'Fijar' }}">
                    {{ $nota->fijada ? '📌' : '📍' }}
                </button>
            </form>

            <!-- Edit button -->
            <a href="{{ route('notas.edit', $nota) }}" class="w-7 h-7 flex items-center justify-center border-2 border-[#1C1C1C] rounded-full bg-white text-xs hover:scale-115 hover:bg-[#FFD166] active:scale-97 transition-all" title="Editar">
                ✏️
            </a>

            <!-- Delete button -->
            <form action="{{ route('notas.destroy', $nota) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta nota?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-7 h-7 flex items-center justify-center border-2 border-[#1C1C1C] rounded-full bg-white text-xs hover:scale-115 hover:bg-[#FF6B6B] active:scale-97 transition-all cursor-pointer" title="Eliminar">
                    🗑️
                </button>
            </form>
        </div>
    </div>
</div>