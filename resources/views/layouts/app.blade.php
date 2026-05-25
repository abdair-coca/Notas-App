<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas App - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Baloo 2"', 'cursive'],
                        body: ['Nunito', 'sans-serif'],
                        fredoka: ['"Baloo 2"', 'cursive'], // Override legacy Fredoka One uses
                        nunito: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        app: {
                            cream: '#FFF8ED',
                            navy: '#3B82F6',
                            yellow: '#FFD166',
                            black: '#1C1C1C',
                        },
                        note: {
                            pink: '#FFE4F0',
                            sky: '#E0F2FE',
                            green: '#D1FAE5',
                            yellow: '#FEF9C3',
                            violet: '#EDE9FE',
                            orange: '#FFEDD5',
                            fuchsia: '#FCE7F3',
                            mint: '#ECFDF5',
                        },
                        accent: {
                            pink: '#FF6B6B',
                            blue: '#3B82F6',
                            green: '#10B981',
                            amber: '#F59E0B',
                            violet: '#8B5CF6',
                            orange: '#F97316',
                            fuchsia: '#EC4899',
                            mint: '#34D399',
                        },
                        // Override brand colors to map to the new palette automatically
                        brand: {
                            yellow: '#FFD166',
                            orange: '#F97316',
                            pink: '#FF6B6B',
                            blue: '#3B82F6',
                            purple: '#8B5CF6',
                            green: '#10B981',
                            bg: '#FFF8ED',
                            dark: '#1C1C1C',
                        },
                    },
                    boxShadow: {
                        'brutal': '4px 4px 0px #1C1C1C',
                        'brutal-lg': '6px 6px 0px #1C1C1C',
                        'brutal-sm': '3px 3px 0px #1C1C1C',
                        'brutal-muted-sm': '3px 3px 0px #ddd',
                        'brutal-muted': '4px 4px 0px #ddd',
                        // Legacy shadow mappings
                        neo: '4px 4px 0px #1C1C1C',
                        'neo-hover': '6px 6px 0px #1C1C1C',
                        'neo-sm': '3px 3px 0px #1C1C1C',
                        'neo-btn': '3px 3px 0px #1C1C1C',
                    },
                    borderRadius: {
                        'card': '20px',
                        'chip': '12px',
                        'badge': '100px',
                    },
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #FFF8ED !important;
            font-family: 'Nunito', sans-serif;
            color: #1C1C1C;
            background-image: radial-gradient(circle, #E8D5B7 1.5px, transparent 1.5px) !important;
            background-size: 28px 28px !important;
        }

        .font-display,
        .font-fredoka {
            font-family: 'Baloo 2', cursive !important;
        }

        .font-body,
        .font-nunito {
            font-family: 'Nunito', sans-serif !important;
        }

        /* Custom shadow utilities */
        .shadow-brutal {
            box-shadow: 4px 4px 0px #1C1C1C !important;
        }

        .shadow-brutal-lg {
            box-shadow: 6px 6px 0px #1C1C1C !important;
        }

        .shadow-brutal-sm {
            box-shadow: 3px 3px 0px #1C1C1C !important;
        }

        /* Note Card styling specifications */
        .note-card {
            border: 2.5px solid #1C1C1C !important;
            border-radius: 20px !important;
            padding: 16px !important;
            box-shadow: 4px 4px 0px #1C1C1C !important;
            transition: transform 0.18s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.18s !important;
        }

        .note-card:hover {
            transform: translateY(-5px) rotate(-1.5deg) !important;
            box-shadow: 6px 6px 0px #1C1C1C !important;
        }

        .note-card-texture {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image: repeating-linear-gradient(-45deg,
                    transparent, transparent 12px,
                    rgba(0, 0, 0, 0.025) 12px, rgba(0, 0, 0, 0.025) 13px) !important;
        }

        /* Floating elements animation */
        @keyframes starFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(15deg);
            }
        }

        .animate-star-float {
            animation: starFloat 4s ease-in-out infinite;
        }

        /* Form styling rules in design.md */
        input,
        textarea,
        select {
            background-color: #FFF8ED !important;
            border: 2.5px solid #1C1C1C !important;
            border-radius: 12px !important;
            padding: 10px 14px !important;
            color: #1C1C1C !important;
            font-family: 'Nunito', sans-serif !important;
            outline: none !important;
            transition: box-shadow 150ms ease !important;
        }

        input:focus,
        textarea:focus,
        select:focus {
            box-shadow: 4px 4px 0px #1C1C1C !important;
        }

        button,
        a.btn {
            font-family: 'Baloo 2', cursive !important;
            transition: transform 150ms, box-shadow 150ms !important;
        }

        button:active,
        a.btn:active {
            transform: scale(0.97) !important;
        }
    </style>
</head>

<body class="bg-brand-bg font-nunito text-brand-dark min-h-screen relative overflow-x-hidden">
    <!-- Floating stars decoration in background -->
    <div class="fixed top-20 left-10 pointer-events-none text-lg text-[#1C1C1C] opacity-35 animate-star-float select-none z-0" style="animation-delay: 0s;">✦</div>
    <div class="fixed top-40 right-12 pointer-events-none text-xl text-[#1C1C1C] opacity-35 animate-star-float select-none z-0" style="animation-delay: 1s;">★</div>
    <div class="fixed bottom-20 left-16 pointer-events-none text-lg text-[#1C1C1C] opacity-35 animate-star-float select-none z-0" style="animation-delay: 2s;">★</div>
    <div class="fixed bottom-40 right-20 pointer-events-none text-xl text-[#1C1C1C] opacity-35 animate-star-float select-none z-0" style="animation-delay: 0.5s;">✦</div>

    <nav class="bg-[#3B82F6] border-b-[3.5px] border-[#1C1C1C] px-6 md:px-8 py-3 sticky top-0 z-50 h-[62px] flex items-center justify-between shadow-brutal-sm">
        <div class="flex items-center justify-between w-full flex-wrap gap-3">
            <a href="{{ route('notas.index') }}"
                class="flex items-center gap-3 hover:rotate-[-2deg] transition-transform duration-150">
                <!-- Icon block 34x34 px -->
                <div class="w-[34px] h-[34px] bg-[#FFD166] border-2 border-[#1C1C1C] rounded-[10px] flex items-center justify-center font-display font-extrabold text-lg text-[#1C1C1C]">N</div>
                <!-- Logo text: Baloo 2, 24px/800, color #FFF8ED -->
                <span class="font-display font-extrabold text-2xl text-[#FFF8ED]">NotasApp</span>
                <!-- Decorative dot: 10x10 px -->
                <div class="w-2.5 h-2.5 bg-[#FFD166] rounded-full border-2 border-[#1C1C1C]"></div>
            </a>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('notas.index') }}"
                    class="font-display font-bold text-sm px-4 py-1.5 rounded-full border-2 border-[#1C1C1C] bg-[#FFF8ED] shadow-brutal-sm text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:shadow-brutal hover:bg-[#FFD166]">
                    📖 Notas
                </a>
                <a href="{{ route('notas.create') }}"
                    class="font-display font-extrabold text-sm px-4 py-1.5 rounded-full border-2 border-[#1C1C1C] bg-[#FFD166] shadow-brutal-sm text-[#1C1C1C] transition-all hover:-translate-y-0.5 hover:shadow-brutal hover:bg-[#FFF8ED]">
                    ➕ Nueva Nota
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6 md:px-6 relative z-10">
        @if(session('success'))
        <div class="mb-6 border-[2.5px] border-[#1C1C1C] rounded-[14px] px-4 py-2.5 flex items-center gap-2.5 font-display font-bold text-sm bg-[#D1FAE5] shadow-brutal-sm relative overflow-hidden">
            <span class="text-lg">✅</span>
            <p class="text-[#1C1C1C] font-extrabold">{{ session('success') }}</p>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 border-[2.5px] border-[#1C1C1C] rounded-[14px] px-4 py-2.5 flex items-center gap-2.5 font-display font-bold text-sm bg-[#FFE4F0] shadow-brutal-sm relative overflow-hidden">
            <span class="text-lg">⚠️</span>
            <p class="text-[#1C1C1C] font-extrabold">{{ session('error') }}</p>
        </div>
        @endif

        @yield('content')
    </main>


    <script>
        let currentForm = null;

        function openModal(formId, modalId) {
            currentForm = document.getElementById(formId);

            const modal = document.getElementById(modalId);

            modal.classList.remove('hidden');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);

            modal.classList.add('hidden');

            currentForm = null;
        }

        function confirmAction(modalId) {
            if (currentForm) {
                currentForm.submit();
            }

            closeModal(modalId);
        }

        const tabTodas = document.getElementById('tab-todas');
        const tabPersonal = document.getElementById('tab-personal');
        const tabTrabajo = document.getElementById('tab-trabajo');
        const tabEstudio = document.getElementById('tab-estudio');
        const tabIdeas = document.getElementById('tab-ideas');

        const currentUrl = window.location.href;
        if (currentUrl.includes('/notas/categoria/Personal')) {
            tabPersonal.classList.remove('border-transparent', 'hover:text-[#3B82F6]', 'text-[#888]');
            tabPersonal.classList.add('border-[#FFD166]', '-mb-[2px]', 'text-[#1C1C1C]');
        } else if (currentUrl.includes('/notas/categoria/Trabajo')) {
            tabTrabajo.classList.remove('border-transparent', 'hover:text-[#3B82F6]', 'text-[#888]');
            tabTrabajo.classList.add('border-[#FFD166]', '-mb-[2px]', 'text-[#1C1C1C]');
        } else if (currentUrl.includes('/notas/categoria/Estudio')) {
            tabEstudio.classList.remove('border-transparent', 'hover:text-[#3B82F6]', 'text-[#888]');
            tabEstudio.classList.add('border-[#FFD166]', '-mb-[2px]', 'text-[#1C1C1C]');
        } else if (currentUrl.includes('/notas/categoria/Ideas')) {
            tabIdeas.classList.remove('border-transparent', 'hover:text-[#3B82F6]', 'text-[#888]');
            tabIdeas.classList.add('border-[#FFD166]', '-mb-[2px]', 'text-[#1C1C1C]');
        } else if (currentUrl.includes('/notas')) {
            tabTodas.classList.remove('border-transparent', 'hover:text-[#3B82F6]', 'text-[#888]');
            tabTodas.classList.add('border-[#FFD166]', '-mb-[2px]', 'text-[#1C1C1C]');
        }
    </script>
</body>

</html>