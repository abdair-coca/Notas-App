/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                naranja:   '#F5A623',
                coral:     '#E85D26',
                mostaza:   '#C47D0E',
                beige:     '#FDF0D5',
                crema:     '#FFFBF2',
                cafe:      '#3D1F00',
                'cafe-md': '#6B3F00',
                'cafe-sm': '#8B6A3E',
                arena:     '#B89060',
                arena2:    '#E8C99A',
            },
        },
    },
    plugins: [],
};
