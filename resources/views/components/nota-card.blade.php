@props(['nota'])


<a href="{{ route('notas.show', $nota) }}"
    class="group block bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">
    <div class="p-5 flex flex-col gap-3 h-full">
        <h3 class="font-fredoka text-lg text-brand-dark group-hover:text-brand-blue transition-colors">
            {{ $nota->titulo }}
        </h3>
        <p class="font-nunito text-sm text-brand-dark/80 flex-1">
            {{ Str::limit($nota->contenido, 100) }}
        </p>
        <span
            class="self-start font-nunito text-xs px-3 py-1 bg-brand-yellow border-[2.5px] border-brand-dark rounded-full shadow-neo-sm">
            {{ $nota->categoria }}
        </span>
        <span>
            {{ $nota->fijada ? '📌 Fijada' : '📍 No fijada' }}
        </span>
    </div>
</a>