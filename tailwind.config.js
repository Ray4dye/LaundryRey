import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#f0f6fe',
                    100: '#ddedfd',
                    200: '#c2e0fc',
                    300: '#99cbfa',
                    400: '#69acf6',
                    500: '#3b86f1',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#0b2257',
                },
                navy: {
                    850: '#0c2253',
                    900: '#091c44',
                    950: '#05112e',
                }
            },
            boxShadow: {
                'app-card': '0 25px 60px -15px rgba(0, 18, 60, 0.35)',
                'app-pill': '0 4px 14px 0 rgba(37, 99, 235, 0.30)',
            }
        },
    },

    plugins: [forms],
};
