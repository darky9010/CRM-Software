const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js",
    ],
    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'primary': '#16a34a',
            'close': '#16a34a',
            'open' : '#4b5563',
            'late' : '#e11d48',
            'secondary': '#166534',
            'gray': {
                50:'#f9fafb',
                100:'#f3f4f6',
                200:'#e5e7eb',
                300:'#d1d5db',
                400:'#9ca3af',
                500:'#6b7280',
                600:'#4b5563',
                700:'#374151',
                800:'#1f2937',
                900:'#111827',
            },
            'red': {
                50: '#fff1f2',
                100: '#ffe4e6',
                200: '#fecdd3',
                300: '#fda4af',
                400: '#fb7185',
                500: '#f43f5e',
                600: '#e11d48',
                700: '#be123c',
                800: '#9f1239',
                900:'#881337',
            },
            'white': '#FFFFFF',
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],

};
