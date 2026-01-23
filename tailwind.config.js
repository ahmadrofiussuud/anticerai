import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
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
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Earthy, natural palette (Amora Green/Cream)
                gray: colors.stone,
                primary: {
                    50: '#f4f7f4',
                    100: '#e3ebe3',
                    200: '#c5d6c5',
                    300: '#9cb69c',
                    400: '#6b7c6b', // Sage
                    500: '#4a6741',
                    600: '#384f38',
                    700: '#2c3e2c', // Button Green
                    800: '#2a3c2a', // Deep Forest Green (Text/Headers)
                    900: '#243224',
                },
                secondary: {
                    50: '#fdfbf7', // Background Cream
                    100: '#f7f3e8',
                    200: '#ede4cc',
                    300: '#e5e0d0', // Borders
                    400: '#d4cebc', // Dots/Accents
                    500: '#b8af96',
                    600: '#9c9276',
                    700: '#7f765f',
                    800: '#696150',
                    900: '#564f43',
                },
                accent: colors.orange, // Warm accent for "Spark" if needed
            },
            boxShadow: {
                'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.15)',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                'pulse-glow': {
                    '0%, 100%': { opacity: '1', transform: 'scale(1)' },
                    '50%': { opacity: '0.8', transform: 'scale(1.05)' },
                }
            },
            animation: {
                float: 'float 6s ease-in-out infinite',
                'float-delayed': 'float 6s ease-in-out 3s infinite',
                'pulse-glow': 'pulse-glow 3s ease-in-out infinite',
            }
        },
    },

    plugins: [forms],
};
