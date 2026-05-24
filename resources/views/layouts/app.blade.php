<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas App - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        fredoka: ['"Fredoka One"', 'cursive'],
                        nunito: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            yellow: '#FFD93D',
                            orange: '#FF6B35',
                            pink: '#FF6B9D',
                            blue: '#4ECDC4',
                            purple: '#A855F7',
                            green: '#6BCB77',
                            bg: '#FFF8F0',
                            dark: '#2D2D2D',
                        },
                    },
                    boxShadow: {
                        neo: '4px 4px 0px #2D2D2D',
                        'neo-hover': '7px 7px 0px #2D2D2D',
                        'neo-sm': '2px 2px 0px #2D2D2D',
                        'neo-btn': '3px 3px 0px #2D2D2D',
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-brand-bg font-nunito text-brand-dark min-h-screen">
    <nav class="bg-brand-yellow border-b-[3px] border-brand-dark px-6 md:px-8 py-3 sticky top-0 z-50">
        <div class="flex items-center justify-between flex-wrap gap-3">

            <a href="{{ route('notas.index') }}"
                class="font-fredoka text-2xl text-brand-dark flex items-center gap-2 hover:rotate-[-2deg] transition-transform">
                NotasApp
            </a>

            <div class="hidden md:flex items-center gap-1.5 flex-wrap">
                <a href="{{ route('notas.index') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    📖 Notas
                </a>
                <a href="{{ route('notas.create') }}"
                    class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-orange shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    ➕ Nota
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6 md:px-6">
        @if(session('success'))
        <div
            class="bg-brand-green border-[3px] border-brand-dark rounded-[20px] px-5 py-4 shadow-neo mb-6 flex items-center gap-3 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-white/20 rounded-full pointer-events-none"></div>
            <span class="text-3xl">🎉</span>
            <p class="font-extrabold text-brand-dark text-sm md:text-base">{{ session('success') }}</p>
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
    </script>
</body>

</html>